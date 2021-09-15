( function( blocks, editor, i18n, element, components, _ ) {
	var __ = i18n.__;
	var el = element.createElement;
	var RichText = editor.RichText;
	var MediaUpload = editor.MediaUpload;

	blocks.registerBlockType( 'gutenberg-examples/custom-load-more-block', {
		title: __( 'Load more post button', 'gutenberg-examples' ),
		icon: 'index-card',
		category: 'layout',
		attributes: {
			
			posts: {
				type: 'array',
				source: 'children',
				selector: '.mjd-load-posts-number',
			}
		},
		edit: function( props ) {
			var attributes = props.attributes;
            
			return el(
				'div',
				{ className: props.className },
				el("h2",{},i18n.__('Custom Load More Block','gutenberg-examples')),

                el( 'h3', {}, i18n.__( 'Number of posts', 'gutenberg-examples' ) ),
				el( RichText, {
					tagName: 'div',
					inline: false,
					placeholder: i18n.__(
						'Number of posts…',
						'gutenberg-examples'
					),
					value: attributes.posts,
					onChange: function( value ) {
						props.setAttributes( { posts: value } );
					},
				} )
			);
		},
		save: function( props ) {
			var attributes = props.attributes;

			return el(
				'div',
				{ className: props.className },
				
				el( 'h3', {}, i18n.__( 'Number of posts', 'gutenberg-examples' ) ),
				el( RichText.Content, {
					tagName: 'div',
					className: 'mjd-load-posts-number',
					value: attributes.posts,
				} )
			);
		},
	} );
} )(
	window.wp.blocks,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components,
	window._
);