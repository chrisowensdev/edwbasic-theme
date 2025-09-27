import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
} from "@wordpress/block-editor";
import { PanelBody, TextControl, Button } from "@wordpress/components";

export default function Edit({ attributes, setAttributes }) {
	const { eyebrow, headline, subcopy, ctaText, ctaUrl, bgUrl } = attributes;
	const blockProps = useBlockProps({
		className: "edw-hero",
		style: bgUrl ? { backgroundImage: `url(${bgUrl})` } : {},
	});

	return (
		<>
			<InspectorControls>
				<PanelBody title={__("Background", "edwbasic-theme")}>
					<MediaUpload
						onSelect={(media) =>
							setAttributes({ bgUrl: media?.url || "" })
						}
						allowedTypes={["image"]}
						render={({ open }) => (
							<Button variant="secondary" onClick={open}>
								{bgUrl
									? __("Change background", "edwbasic-theme")
									: __("Select background", "edwbasic-theme")}
							</Button>
						)}
					/>
					{bgUrl && (
						<Button
							variant="link"
							onClick={() => setAttributes({ bgUrl: "" })}
						>
							{__("Remove background", "edwbasic-theme")}
						</Button>
					)}
				</PanelBody>
				<PanelBody
					title={__("Button", "edwbasic-theme")}
					initialOpen={false}
				>
					<TextControl
						label={__("Button text", "edwbasic-theme")}
						value={ctaText}
						onChange={(v) => setAttributes({ ctaText: v })}
					/>
					<TextControl
						label={__("Button URL", "edwbasic-theme")}
						value={ctaUrl}
						onChange={(v) => setAttributes({ ctaUrl: v })}
						placeholder="https://"
					/>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="edw-hero__inner">
					<RichText
						tagName="p"
						className="edw-hero__eyebrow"
						value={eyebrow}
						onChange={(v) => setAttributes({ eyebrow: v })}
						placeholder={__("Eyebrow (optional)", "edwbasic-theme")}
					/>
					<RichText
						tagName="h1"
						className="edw-hero__headline"
						value={headline}
						onChange={(v) => setAttributes({ headline: v })}
						placeholder={__("Add headline…", "edwbasic-theme")}
					/>
					<RichText
						tagName="div"
						className="edw-hero__subcopy"
						value={subcopy}
						onChange={(v) => setAttributes({ subcopy: v })}
						placeholder={__(
							"Add supporting copy…",
							"edwbasic-theme"
						)}
					/>
					{ctaText ||
						(ctaUrl && (
							<p className="edw-hero__cta">
								<a
									className="wp-block-button__link"
									href={ctaUrl || "#"}
								>
									{ctaText ||
										__("Learn more", "edwbasic-theme")}
								</a>
							</p>
						))}
				</div>
			</section>
		</>
	);
}
