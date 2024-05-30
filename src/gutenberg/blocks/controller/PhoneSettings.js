import {PanelBody} from '@wordpress/components';
import {__} from "@wordpress/i18n";
import {Dimension, Color, Typography} from "../../components/Components";

export default function PhoneSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        phone_typography,
        phone_spacing,
        phone_color,
        phone_color_hover,
    } = attributes;

    return (
        <PanelBody title={__('Phone', 'user-grid')} initialOpen={false}>

            <Typography
                label={__('Typography')}
                value={phone_typography}
                onChange={(val) => setAttributes({phone_typography: val})}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={phone_spacing}
                onChange={(value) => {
                    setAttributes({phone_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={phone_color}
                onChange={(phone_color) => setAttributes({phone_color})}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={phone_color_hover}
                onChange={(phone_color_hover) => setAttributes({phone_color_hover})}
            />

        </PanelBody>
    );
}
