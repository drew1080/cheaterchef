(function() {
	tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
		editor.addButton('my_mce_button', {
			title : 'JumpToRecipe Shortcode', // title of the button
      image : '../wp-includes/images/smilies/icon_mrgreen.gif',  // path to the button's image
			onclick: function() {
				editor.insertContent('<a href="#blog-yumprint-recipe">Jump to the recipe</a>');
			}
		});
	});
})();