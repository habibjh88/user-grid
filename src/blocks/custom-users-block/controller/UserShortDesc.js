import {
    PanelBody,
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";
const {__} = wp.i18n;

function UserShortDesc(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        short_desc_typography,
        short_desc_spacing,
        short_desc_color,
    } = attributes;

    return (
        <PanelBody title={__('User Biography', 'user-grid')} initialOpen={false}>


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

export default UserShortDesc;
