/** 
  * @desc this class will provide Calculator interface to user interaction
  * @author Steven Liu
  * @date 06/02/2015
*/
function BasicCalculator (display) {
  this.display = display; // <input type=text ...> element
  this.MAX_DISPLAY_LENGTH = 20;
  this.INFINITE_VALUE = "INF";

  this.STATES =  {
    START : 0, 
    A: 1,
    B: 2,
    C: 3,
    D: 4,
    E: 5
  }
  this.TYPE = {
    DIGIT: "dig",
    DOT: "dot",
    OPERATION: "opt",
    EQUAL: "equ",
    PERCENT: "per",
    REVERSE: "rev",
    UNKOWN: "unk"
  }
  this.clear();
}

// append single number to display
BasicCalculator.prototype.appendDisplay = function(value) {
  var futureLength = this.display.value.length + 1;
  if (futureLength > this.MAX_DISPLAY_LENGTH) {
    alert("can't display String longer than " + this.MAX_DISPLAY_LENGTH);
    return;
  }
  this.display.value += value;
}

// set display to a string
BasicCalculator.prototype.setDisplay = function(value) {
  var str = value.toString();
  
  if(str.length > this.MAX_DISPLAY_LENGTH) {
    alert("can't display String longer than " + this.MAX_DISPLAY_LENGTH);
    return;
  }
  
  this.display.value = value;
}

// reverse display to a string
BasicCalculator.prototype.reverseDisplay = function() {
  if (this.display.value[0] == "-")
    this.display.value = this.display.value.substr(1);
  else
    this.display.value = '-' + this.display.value;
}

// get value of display
BasicCalculator.prototype.getDisplay = function() {
  if (this.display.value.length > this.MAX_DISPLAY_LENGTH) {
    alert("can't calculate with a number longer than " + this.MAX_DISPLAY_LENGTH + " !");
    return 0;
  } 

  if (this.display.value == this.INFINITE_VALUE) {
    //alert("can't calculate with an infinite number!");
    return 0;
  }
  return this.display.value;
}

// clear display and initialize calculator
BasicCalculator.prototype.clear = function() {
  this.state = this.STATES.START;
  this.setDisplay(0); 
  this.opt = "+";
  this.op1 = 0
  this.op2 = 0
  this.result = 0
}

// get key type according to key name(+,-,*,/,0,1,2...)
BasicCalculator.prototype.getKeyType = function(value) {
  var type;
  if (value >= 0 && value <= 9)
    type = this.TYPE.DIGIT;
  else if (value == "+" || value == "-" || value == "*" || value == "/" )
    type = this.TYPE.OPERATION;
  else if (value == '.')
    type = this.TYPE.DOT;
  else if (value  == '=')
    type = this.TYPE.EQUAL;
  else if (value == '%')
    type = this.PERCENT;
  else if (value == "r")
    type = this.REVERSE;
  else
    type = this.TYPE.UNKOWN;

  return type;
}

// calculate result by server API, AJAX
// display result and copy result to op1
BasicCalculator.prototype.calculate_remote = function() {
  this.op2 = this.getDisplay();
  var optStr;
  switch (this.opt) {
    case "+":
      optStr = "add";
      break;
    case "-":
      optStr = "subtract";
      break;
    case "*":
      optStr = "multiply";
      break;
    case "/":
      optStr = "divide";
      break;
  }
  var statusCodeResponses;
  var urlStr = "http://calculator.hudeven.com/calculator/"+ optStr +"/"+ this.op1 +"/" + this.op2;
  var cal_response = $.ajax({
        type: "GET",
        url: urlStr,
        async: false
    });

  if (cal_response.status != 200) {
    alert("Invalid operation!\n\n\n" + cal_response.responseText);
    return;
  } 
  
  var data = $.parseJSON(cal_response.responseText);
  if (data.error) {  
    alert(data.error);
  } else {
    this.setDisplay(data.result);
    // move result to op1 for continuous calculation
    this.op1 = data.result;
  }
  
};

// calculate result by browser
// display result and copy result to op1
BasicCalculator.prototype.calculate = function() {
  this.op2 = this.getDisplay();
  var op1 = Number(this.op1)
  var op2 = Number(this.op2)
  switch (this.opt) {
    case "+":
      this.result = op1 + op2;
      break;
    case "-":
	this.result = op1 - op2;
	break;
    case "*":
	this.result = op1 * op2;
	break;
    case "/":
	this.result = op1 / op2;
  }

  this.setDisplay(this.result);
  // move result to op1 for continuous calculation
  this.op1 = this.result;
}

// a state machine to dicide what to do in each state
// see state diagram in @AcmeCalculatorBundle/docs/calculator_state_machine.jpg
BasicCalculator.prototype.state_machine = function(type, value) {
  if (type == this.TYPE.PERCENT) {
    this.setDisplay(this.getDisplay() / 100);
    return;
  } else if (type == this.TYPE.REVERSE) {
    this.reverseDisplay();
    return;
  }

  switch (this.state) {
    
    case this.STATES.START:
      switch (type) {
        case this.TYPE.DIGIT:
          this.state = this.STATES.A;
          this.setDisplay(value);
          break;
        case this.TYPE.DOT:
          this.state = this.STATES.B;
          this.appendDisplay(value);
          break;
        case this.TYPE.OPERATION:
          this.state = this.STATES.C;
	        this.opt = value;
          this.op1 = this.getDisplay();
          break;
        case this.TYPE.EQUAL:// do nothing
	        // stay same state
	        this.calculate_remote();
          break;
	      default:
	        // invalid operation!
      }
      break;

    case this.STATES.A:
      switch (type) {
        case this.TYPE.DIGIT:
          // stay same state
          this.appendDisplay(value);
          break;
        case this.TYPE.DOT:
          this.state = this.STATES.B;
          this.appendDisplay(value);
	        break;
        case this.TYPE.OPERATION:
          this.state = this.STATES.C;
          this.opt = value;
          this.op1 = this.getDisplay();
          break;
        case this.TYPE.EQUAL:
          this.state = this.STATES.START;
          break;
        default:
	        alert("invalid operation!");
      }
      break;

   case this.STATES.B:
     switch(type) {
	      case this.TYPE.DIGIT:
	        // stay same state
	        this.appendDisplay(value);
	        break;
	      case this.TYPE.DOT:
	        // stay same state
	        break;
	      case this.TYPE.OPERATION:
	        this.state = this.STATES.C;
	        this.opt = value
	        this.op1 = this.getDisplay();
	        break;
	      case this.TYPE.EQUAL:
	        this.state = this.STATES.S;
	        break;
	      default:
	        alert("invalid operation!");
     }
     break;

    case this.STATES.C:
      switch (type) {
        case this.TYPE.DIGIT:
        this.state = this.STATES.D;
	      this.setDisplay(value); 
        break;
	    case this.TYPE.DOT:
	      this.state = this.STATES.E;
	      this.setDisplay(value); 
	       break;
	    case this.TYPE.OPERATION:
	      // stay same state
	      this.opt = value;
	      break;
	    case this.TYPE.EQUAL:
	      this.state = this.STATES.START;
	      this.calculate_remote();
	    default:
	      alert("invalid operation!");
      }
      break;

    case this.STATES.D:
      switch (type) {
        case this.TYPE.DIGIT:
	        // stay same state
	        this.appendDisplay(value);
	        break;
	      case this.TYPE.DOT:
	        this.state = this.STATES.E;
	        this.appendDisplay(value);
	        break;
        case this.TYPE.OPERATION:
	        // consider the priority order
	        // 1 + 2 * 3 = 7,  1 * 2 + 3 = 5
	        this.state = this.STATES.C;
	        this.calculate_remote();
          this.opt = value;
	        break;
        case this.TYPE.EQUAL:
          this.state = this.STATES.START;
	        this.calculate_remote();
	        break;
	      default:
	        alert("invalid operation!");
      }
      break;

   case this.STATES.E:
      switch (type) {
	      case this.TYPE.DIGIT:
	        // stay same state
	        this.appendDisplay(value);
	        break;
	      case this.TYPE.DOT:
	        // stay same state
	        break;
	      case this.TYPE.OPERATION:
	        this.state = this.STATES.C;
	        this.calculate_remote();
	        this.opt = value;
	        break;
	      case this.TYPE.EQUAL:
	        this.state = this.STATES.START;
	        this.calculate_remote();
	        break;
	      default:
	        alert("invalid operation!");
     }
  }

}

//to record which key is pressed last time
//var lastKeyValue;

$(document).ready(function() {
  var basicCal = new BasicCalculator(document.getElementById("cal-display"));

  $(".btn-general").click(function(e) {
    e.preventDefault();
    var type = $(e.currentTarget).data("type");
    var value = $(e.currentTarget).data("value");
    return basicCal.state_machine(type, value);
  });
  
  $(".btn-clear").click(function(e) {
    e.preventDefault();
    return basicCal.clear();
  });
  
  $(document).keypress(function(e) {
    if ($('#cal-display').is(':focus'))
      return;
    var value = String.fromCharCode(e.charCode);
    $('a[data-value="'+ value  +'"]').click();
    
    // bug: 2 simultaneous clicking may cause some key keep inactive state
    //$('a[data-value="'+ value  +'"]').addClass("active");
    //lastKeyValue = value;
  });

  $(document).keyup(function(e) {
    // challenge: detect key charcode and remove its "active" class
    //$('a[data-value="'+ lastKeyValue  +'"]').removeClass("active");
  });
  
});
