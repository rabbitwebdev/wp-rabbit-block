const { registerBlockType } = wp.blocks;
const { RichText, InspectorControls, PanelColorSettings } = wp.blockEditor;
const { PanelBody } = wp.components;
const { __ } = wp.i18n;

registerBlockType("custom/block", {
    title: __("Custom Block", "custom-block"),
    icon: "admin-customizer",
    category: "common",
    attributes: {
        content: {
            type: "string",
            default: "Hello, Gutenberg!"
        },
        textColor: {
            type: "string",
            default: "#000000"
        },
        backgroundColor: {
            type: "string",
            default: "#ffffff"
        }
    },
    edit: ({ attributes, setAttributes }) => {
        const { content, textColor, backgroundColor } = attributes;

        return (
            <>
                <InspectorControls>
                    <PanelBody title={__("Color Settings", "custom-block")}>
                        <PanelColorSettings
                            title={__("Text & Background Color", "custom-block")}
                            colorSettings={[
                                {
                                    value: textColor,
                                    onChange: (color) => setAttributes({ textColor: color }),
                                    label: __("Text Color", "custom-block")
                                },
                                {
                                    value: backgroundColor,
                                    onChange: (color) => setAttributes({ backgroundColor: color }),
                                    label: __("Background Color", "custom-block")
                                }
                            ]}
                        />
                    </PanelBody>
                </InspectorControls>
                <RichText
                    tagName="p"
                    value={content}
                    onChange={(newContent) => setAttributes({ content: newContent })}
                    style={{ color: textColor, backgroundColor, padding: "10px" }}
                />
            </>
        );
    },
    save: ({ attributes }) => {
        const { content, textColor, backgroundColor } = attributes;

        return (
            <RichText.Content
                tagName="p"
                value={content}
                style={{ color: textColor, backgroundColor, padding: "10px" }}
            />
        );
    }
});
