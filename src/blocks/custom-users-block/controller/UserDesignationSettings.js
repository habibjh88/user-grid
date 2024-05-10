import {
    PanelBody,
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";

const {__} = wp.i18n;

function UserDesignationSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        designation_typography,
        designation_spacing,
        designation_color,
    } = attributes;

    return (
        <PanelBody title={__('User Designation', 'user-grid')} initialOpen={false}>

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

export default UserDesignationSettings;
