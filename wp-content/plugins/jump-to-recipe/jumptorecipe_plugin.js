// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.jumptorecipe', {
		// creates control instances based on the control's id.
		// our button's id is "mygallery_button"
		createControl : function(id, controlManager) {
			if (id == 'jumptorecipe_button') {
				// creates the button
				var button = controlManager.createButton('jumptorecipe_button', {
					title : 'JumpToRecipe Shortcode', // title of the button
					image : '../wp-includes/images/smilies/icon_mrgreen.gif',  // path to the button's image
					onclick : function() {
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '<a href="#blog-yumprint-recipe">Jump to the recipe</a>');
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('jumptorecipe', tinymce.plugins.jumptorecipe);
	
})()