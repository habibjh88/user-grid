import {PanelBody} from '@wordpress/components';
import {Dimension, Color, Typography} from "../../components/Components";
import {__} from "@wordpress/i18n";

function DesignationSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        designation_typography,
        designation_spacing,
        designation_color,
    } = attributes;

    return (
        <PanelBody title={__('Designation', 'user-grid')} initialOpen={false}>

            <Typography
                label={__('Typography')}
                value={designation_typography}
                onChange={(val) => setAttributes({designation_typography: val})}
            />

            <Dimension
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={designation_spacing}
                onChange={(value) => {
                    setAttributes({designation_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={designation_color}
                onChange={(designation_color) => setAttributes({designation_color})}
            />
        </PanelBody>
    );
}

export default DesignationSettings;
