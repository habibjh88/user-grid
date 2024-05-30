import {__} from "@wordpress/i18n";
import {PanelBody} from '@wordpress/components';
import {Dimension, Color, Typography} from "../../components/Components";

export default function EmailSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        email_typography,
        email_spacing,
        email_color,
        email_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('Email', 'user-grid')} initialOpen={false}>

            <Typography
                label={__('Typography')}
                value={email_typography}
                onChange={(val) => setAttributes({email_typography: val})}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={email_spacing}
                onChange={(value) => {
                    setAttributes({email_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={email_color}
                onChange={(email_color) => setAttributes({email_color})}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={email_color_hover}
                onChange={(email_color_hover) => setAttributes({email_color_hover})}
            />

        </PanelBody>
    );
}
