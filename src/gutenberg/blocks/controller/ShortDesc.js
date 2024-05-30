import {__} from "@wordpress/i18n";
import {PanelBody} from '@wordpress/components';
import {Dimension, Color, Typography} from "../../components/Components";

function ShortDesc(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        short_desc_typography,
        short_desc_spacing,
        short_desc_color,
    } = attributes;

    return (
        <PanelBody title={__('Short Description', 'user-grid')} initialOpen={false}>


            <Typography
                label={__('Typography')}
                value={short_desc_typography}
                onChange={(val) => setAttributes({short_desc_typography: val})}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={short_desc_spacing}
                onChange={(value) => {
                    setAttributes({short_desc_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={short_desc_color}
                onChange={(short_desc_color) => setAttributes({short_desc_color})}
            />

        </PanelBody>
    );
}

export default ShortDesc;
