// module invoked by jQuery on DOM ready
$(function() {

	// event listener and error reporting
	$('form').on('submit', function(e) {
		var $form = $(this);

		e.preventDefault();

		try {
			runArrayFunction($form);
		} catch(e) {
			console.log(e);
			$('.result', $form).text('<error: ' + e.message + '>');
		}

	});

	// Respond to form submit.
	// The specific function to call, as well as info on the
	// data type its of arguments, is rolled into the markup.
	function runArrayFunction($form) {

		// name of function to be called.
		// check first for a value to the submit
		// and then for the data-fn property of the form
		var fnName = $('input[type="submit"]:focus').val() || $form.data('fn'),

			$inputs = $('input:not([type="submit"])', $form), // text inputs
			$result = $('.result', $form),                    // the output
			args, result;

		if (fnName) { // only do anything if there is something to call

			args = processArgs($inputs);						// get the input arguments
			result = Functions[fnName].apply(Functions, args);	// call the function
			$result.text(processResult(result));				// insert back into form

		}

	}

	// iterates through each input and returns an array of
	// arguments to be passed to the exercise function.
	function processArgs($inputs) {

		// each input becomes an argument
		return _.map($inputs, function(input) {

			var $input = $(input),
				dataTypes = $input.attr('class').toLowerCase().split(/\s+/),
				i, result;

			for (i = 0; i < dataTypes.length; i++) {
				result = evalAsDataType($input, dataTypes[i]);
				if (result) { return result[0] } // unwrap from array container
			}

			return undefined;

		});
	}

	// wraps the return value in an array, so null and undefined can be returned
	function evalAsDataType($input, dataType) {

		var val = $input.val();

		if (val.length === 0) {
			if (dataType === "undefined")
				return [ undefined ];
			if (dataType === "null")
				return [ null ];
		}

		// unaltered string
		if (dataType === "string")
			return [ val ];

		// best to trim for remainder of datatypes
		val = val.trim();

		switch(dataType) {
			case 'integer':
				if (val.match(/^-?\d+$/))
					return [ parseInt(val) ];
				break; // no match
			case 'float':
				if (val.match(/^-?\d+\.?\d*$/))
					return [ parseFloat(val) ];
				break; // no match
			case 'integers': // array of integers: all other characters are treated as separators
				return [ _.map(val.match(/-?\d+/g), parseInt) ];
			case 'floats':   // array of floats: all other characters are treated as separators
				return [ _.map(val.match(/-?\d+\.?\d*/g), parseFloat) ];
			case 'words':    // array of words: all other characters are treated as separators
				return [ val.split(/\W+/) ];
			case 'expression':
				try {
					return [ eval('(' + val + ')') ]; // safer evaluation with parens...
				} catch(e) {
					try {
						return [ eval(val) ]; // ...but covers a couple edge cases like empty string
					} catch(e2) {
						break; // eval failed
					}
				}
		}

		return null; // did not match requested data type

	}

	// any post-function processing. At the moment supports
	// reporting the value of Hash and Arrays types.
	function processResult(result) {

		// inspect hash or array structures
		if (typeof result === 'object') {
			return JSON.stringify(result);
		} else if (result === 'null') {
			return '<null>';
		} else if (typeof result === 'undefined') {
			return '<undefined>';
		}

		return result;
	}

});
