import {
    PanelBody,
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";

const {__} = wp.i18n;

function UserEmail(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        email_typography,
        email_spacing,
        email_color,
        email_color_hover
    } = attributes;

    return (
        <PanelBody title={__('User Email', 'gutenberg-users')} initialOpen={false}>

            <Typography
                label={__('Typography')}
                value={email_typography}
                onChange={(val) => setAttributes({email_typography: val})}
            />

            <Dimension
                label={__("Spacing", "gutenberg-users")}
                type="margin" responsive
                value={email_spacing}
                onChange={(value) => {
                    setAttributes({email_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'gutenberg-users')}
                color={email_color}
                onChange={(email_color) => setAttributes({email_color})}
            />

            <Color
                label={__('Color - Hover', 'gutenberg-users')}
                color={email_color_hover}
                onChange={(email_color_hover) => setAttributes({email_color_hover})}
            />

        </PanelBody>
    );
}

export default UserEmail;
