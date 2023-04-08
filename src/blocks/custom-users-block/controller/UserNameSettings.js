import {
    SelectControl,
    PanelBody,
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";

const {__} = wp.i18n;
import {HEADING} from "../../../components/Constants";

function UserNameSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        name_tag,
        name_typography,
        name_spacing,
        name_color,
        name_color_hover
    } = attributes;

    return (
        <PanelBody title={__('User Name', 'gutenberg-users')} initialOpen={false}>

            <SelectControl
                label={__('Name Tags', 'gutenberg-users')}
                className="gtusers-control-field label-inline"
                options={HEADING}
                value={name_tag}
                onChange={(name_tag) => setAttributes({name_tag})}
            />

            <Typography
                label={__('Typography')}
                value={name_typography}
                onChange={(val) => setAttributes({name_typography: val})}
            />

            <Dimension
                label={__("Spacing", "gutenberg-users")}
                type="margin" responsive
                value={name_spacing}
                onChange={(value) => {
                    setAttributes({name_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'gutenberg-users')}
                color={name_color}
                onChange={(name_color) => setAttributes({name_color})}
            />

            <Color
                label={__('Color - Hover', 'gutenberg-users')}
                color={name_color_hover}
                onChange={(name_color_hover) => setAttributes({name_color_hover})}
            />

        </PanelBody>
    );
}

export default UserNameSettings;
