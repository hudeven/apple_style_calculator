function BasicCalculator (display) {
  this.display = display; // a textbox control
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
    UNKOWN: "unk"
  }
  this.clear();
}

BasicCalculator.prototype.clear = function() {
  this.state = this.STATES.START;
  this.display.innerHTML = "0"; 
  this.opt = "+";
  this.op1 = 0
  this.op2 = 0
  this.result = 0
}

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
  else
    type = this.TYPE.UNKOWN;

  return type;
}

BasicCalculator.prototype.calculate_remote = function() {
  this.op2 = this.display.innerHTML;
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
  var urlStr = "http://calculator.hudeven.com/app_dev.php/calculator/"+ optStr +"/"+ this.op1 +"/" + this.op2;
  this.result = $.ajax({
        type: "GET",
        url: urlStr,
        async: false
    }).responseText;

  this.display.innerHTML = this.result;
  // move result to op1 for continuous calculation
  this.op1 = this.result;
};

BasicCalculator.prototype.calculate = function() {
  this.op2 = this.display.innerHTML;
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

  this.display.innerHTML = this.result;
  // move result to op1 for continuous calculation
  this.op1 = this.result;
}

BasicCalculator.prototype.state_machine = function(type, value) {
  switch (this.state) {
    case this.STATES.START:
      switch (type) {
        case this.TYPE.DIGIT:
          this.state = this.STATES.A;
          this.display.innerHTML = value;
          break;
        case this.TYPE.DOT:
          this.state = this.STATES.B;
          this.display.innerHTML += value;
          break;
        case this.TYPE.OPERATION:
          this.state = this.STATES.C;
	  this.opt = value;
          this.op1 = this.display.innerHTML;
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
          this.display.innerHTML += value;
          break;
        case this.TYPE.DOT:
          this.state = this.STATES.B;
          this.display.innerHTML += value;
	  break;
        case this.TYPE.OPERATION:
          this.state = this.STATES.C;
          this.opt = value;
          this.op1 = this.display.innerHTML;
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
	  this.display.innerHTML += value;
	  break;
	case this.TYPE.DOT:
	  // stay same state
	  break;
	case this.TYPE.OPERATION:
	  this.state = this.STATES.C;
	  this.opt = value
	  this.op1 = this.display.innerHTML;
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
	  this.display.innerHTML = value; 
          break;
	case this.TYPE.DOT:
	  this.state = this.STATES.E;
	  this.display.innerHTML = value; 
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
	  this.display.innerHTML += value;
	  break;
	case this.TYPE.DOT:
	  this.state = this.STATES.E;
	  this.display.innerHTML += value;
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
	  this.display.innerHTML += value;
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

var lastKeyValue;

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
    var value = String.fromCharCode(e.charCode);
    $('a[data-value="'+ value  +'"]').click();
    $('a[data-value="'+ value  +'"]').addClass("active");
    lastKeyValue = value;
  });

  $(document).keyup(function(e) {
    $('a[data-value="'+ lastKeyValue  +'"]').removeClass("active");
  });


  
});
