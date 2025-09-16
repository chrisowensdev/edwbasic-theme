(function (wp) {
	const { registerBlockType } = wp.blocks;
	const { __ } = wp.i18n;
	const { useBlockProps, RichText, InspectorControls, MediaUpload } =
		wp.blockEditor || wp.editor;
	const { PanelBody, TextControl, Button } = wp.components;
	const el = wp.element.createElement;

	registerBlockType("edw/hero", {
		title: __("Hero Banner", "edwbasic-theme"),
		icon: "slides",
		category: "layout",
		example: {
			attributes: {
				eyebrow: "Trusted by 200+ contractors",
				headline: "Win More Jobs With Faster Estimates",
				subcopy: "Create, send, and get paid—right from your phone.",
				ctaText: "Get Started",
				ctaUrl: "#",
				bgUrl: "https://placehold.co/1600X900",
			},
			// Optional: preview inner blocks (buttons, etc.)
			// innerBlocks works in JS examples:
			// innerBlocks: [
			//   [ 'core/buttons', {}, [ [ 'core/button', { text: 'Try it free' } ] ] ]
			// ]
		},
		attributes: {
			eyebrow: { type: "string", default: "" },
			headline: { type: "string", default: "Your headline" },
			subcopy: { type: "string", default: "" },
			ctaText: { type: "string", default: "" },
			ctaUrl: { type: "string", default: "" },
			bgUrl: { type: "string", default: "" },
		},

		edit: (props) => {
			const { attributes, setAttributes } = props;
			const { eyebrow, headline, subcopy, ctaText, ctaUrl, bgUrl } =
				attributes;
			const blockProps = useBlockProps({
				className: "edw-hero",
				style: bgUrl ? { backgroundImage: "url(" + bgUrl + ")" } : {},
			});

			return el(
				wp.element.Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __("Background", "edwbasic-theme") },
						el(MediaUpload, {
							onSelect: (m) =>
								setAttributes({ bgUrl: (m && m.url) || "" }),
							allowedTypes: ["image"],
							render: ({ open }) =>
								el(
									Button,
									{ variant: "secondary", onClick: open },
									bgUrl
										? __(
												"Change background",
												"edwbasic-theme"
										  )
										: __(
												"Select background",
												"edwbasic-theme"
										  )
								),
						}),
						bgUrl &&
							el(
								Button,
								{
									variant: "link",
									onClick: () => setAttributes({ bgUrl: "" }),
								},
								__("Remove background", "edwbasic-theme")
							)
					),
					el(
						PanelBody,
						{
							title: __("Button", "edwbasic-theme"),
							initialOpen: false,
						},
						el(TextControl, {
							label: __("Button text", "edwbasic-theme"),
							value: ctaText,
							onChange: (v) => setAttributes({ ctaText: v }),
						}),
						el(TextControl, {
							label: __("Button URL", "edwbasic-theme"),
							value: ctaUrl,
							onChange: (v) => setAttributes({ ctaUrl: v }),
							placeholder: "https://",
						})
					)
				),
				el(
					"section",
					blockProps,
					el(
						"div",
						{ className: "edw-hero__inner" },
						el(RichText, {
							tagName: "p",
							className: "edw-hero__eyebrow",
							value: eyebrow,
							onChange: (v) => setAttributes({ eyebrow: v }),
							placeholder: __("Eyebrow…", "edwbasic-theme"),
						}),
						el(RichText, {
							tagName: "h1",
							className: "edw-hero__headline",
							value: headline,
							onChange: (v) => setAttributes({ headline: v }),
							placeholder: __("Add headline…", "edwbasic-theme"),
						}),
						el(RichText, {
							tagName: "div",
							className: "edw-hero__subcopy",
							value: subcopy,
							onChange: (v) => setAttributes({ subcopy: v }),
							placeholder: __(
								"Add supporting copy…",
								"edwbasic-theme"
							),
						}),
						(ctaText || ctaUrl) &&
							el(
								"p",
								{ className: "edw-hero__cta" },
								el(
									"a",
									{
										className: "wp-block-button__link",
										href: ctaUrl || "#",
									},
									ctaText ||
										__("Learn more", "edwbasic-theme")
								)
							)
					)
				)
			);
		},

		save: (props) => {
			const { eyebrow, headline, subcopy, ctaText, ctaUrl, bgUrl } =
				props.attributes;
			const blockProps = useBlockProps.save({
				className: "edw-hero",
				style: bgUrl ? { backgroundImage: "url(" + bgUrl + ")" } : {},
			});

			return el(
				"section",
				blockProps,
				el(
					"div",
					{ className: "edw-hero__inner" },
					eyebrow &&
						el(RichText.Content, {
							tagName: "p",
							className: "edw-hero__eyebrow",
							value: eyebrow,
						}),
					headline &&
						el(RichText.Content, {
							tagName: "h1",
							className: "edw-hero__headline",
							value: headline,
						}),
					subcopy &&
						el(RichText.Content, {
							tagName: "div",
							className: "edw-hero__subcopy",
							value: subcopy,
						}),
					ctaText &&
						ctaUrl &&
						el(
							"p",
							{ className: "edw-hero__cta" },
							el(
								"a",
								{
									className: "wp-block-button__link",
									href: ctaUrl,
								},
								ctaText
							)
						)
				)
			);
		},
	});
})(window.wp);
