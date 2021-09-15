( function( blocks, editor, i18n, element, components, _ ) {
	var __ = i18n.__;
	var el = element.createElement;
	var RichText = editor.RichText;
	var MediaUpload = editor.MediaUpload;

	blocks.registerBlockType( 'gutenberg-examples/custom-slider-block', {
		title: __( 'Custom Slider', 'gutenberg-examples' ),
		icon: 'index-card',
		category: 'layout',
		attributes: {
			
			terms: {
				type: 'array',
				source: 'children',
				selector: '.terms',
			},
            images: {
				type: 'array',
				source: 'children',
				selector: '.images',
			},
		},

		edit: function( props ) {
			var attributes = props.attributes;

			var onSelectImage = function( media ) {
				return props.setAttributes( {
					mediaURL: media.url,
					mediaID: media.id,
				} );
			};
            
			return el(
				'div',
				{ className: props.className },
				el("h2",{},i18n.__('Custom Slider Block','gutenberg-examples')),
				el( 'h3', {}, i18n.__( 'Terms', 'gutenberg-examples' ) ),
				el( RichText, {
					tagName: 'div',
					inline: false,
					placeholder: i18n.__(
						'Write terms',
						'gutenberg-examples'
					),
					value: attributes.terms,
					onChange: function( value ) {
						props.setAttributes( { terms: value } );
					},
				} ),

                el( 'h3', {}, i18n.__( 'Number of images', 'gutenberg-examples' ) ),
				el( RichText, {
					tagName: 'div',
					inline: false,
					placeholder: i18n.__(
						'Write instructions…',
						'gutenberg-examples'
					),
					value: attributes.images,
					onChange: function( value ) {
						props.setAttributes( { images: value } );
					},
				} )
			);
		},
		save: function( props ) {
			var attributes = props.attributes;

			return el(
				'div',
				{ className: props.className },
				
				el( 'h3', {}, i18n.__( 'Terms', 'gutenberg-examples' ) ),
				el( RichText.Content, {
					tagName: 'div',
					className: 'terms',
					value: attributes.terms,
				} ),
                el( 'h3', {}, i18n.__( 'Number of images', 'gutenberg-examples' ) ),
				el( RichText.Content, {
					tagName: 'div',
					className: 'images',
					value: attributes.images,
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