var formObject = {
	run : function() {
		formObject.callEditClick($('.edit'));
		formObject.callUpdateBlur($('.updateBlur'));
		formObject.callUpdateEnter($('.field'));
		formObject.callCancel($('.close'));
	},
	callEditClick : function(obj) {
		obj.live('click', function() {
			formObject.callEdit($(this));
			return false;
		});
	},
	callUpdateBlur : function(obj) {
		obj.live('blur', function() {
			formObject.callUpdate($(this));
			return false;
		});
	},
	callUpdateEnter : function(obj) {
		obj.live('keypress', function(event) {
			var thisCode = event.keyCode ? event.keyCode : event.which;
			if (thisCode === 13) {
				formObject.callUpdate($(this));
				return false;
			}
		});
	},
	callEdit : function(obj) {
		obj.hide();
		obj.next().show();
	},
	callCancel : function(obj) {
		obj.live('click', function() {
			$(this).parent().hide();
			$(this).parent().prev('.edit').show();
			return false;
		});
	},
	callUpdate : function(obj) {
		var thisItem = obj;
		var thisValue = thisItem.val();
		var thisSourceValue = thisItem.parent().prev('.edit').text();
		if (thisValue !== thisSourceValue) {
			var thisKey = thisItem.attr('id');
			var thisId = thisItem.attr('data-id');
			thisItem.next('.processing').show();
			jQuery.post('/mod/update.php', { key : thisKey, value : thisValue, id : thisId }, function(data) {
				thisItem.next('.processing').hide();
				if (!data.error) {
					thisItem.parent().prev('.edit').html(thisValue);
				}
			}, 'json');
		}
	}
};
$(function() {
	formObject.run();
});







