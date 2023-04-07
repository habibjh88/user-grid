import {
    __experimentalBorderControl as BorderControl,
    Button,
    ToggleControl,
    SelectControl,
    PanelBody,
    Dropdown, __experimentalHeading as Heading, TextControl
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";
import RangeDevice from "../../../components/RangeDevice";

const {__} = wp.i18n;
import {HEADING, TPG_COLOR_PALATE} from "../../../components/Constants";

function UserBio(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        bio_typography,
        bio_spacing,
        bio_color,
        bio_visible_for,
        show_message_frontend
    } = attributes;

    return (
        <PanelBody title={__('User Biography', 'gutenberg-users')} initialOpen={false}>

            <SelectControl
                label={__("Bio Visible For", "gutenberg-users")}
                className="gtusers-control-field label-inline"
                options={[
                    {value: 'all', label: 'All Users'},
                    {value: 'loggedin', label: 'Logged in Users'},
                ]}
                help={__("If you don't want to show this for non logged in users then choose 2nd option", "gutenberg-users")}
                value={bio_visible_for}
                onChange={(bio_visible_for) => {
                    setAttributes({bio_visible_for})
                }}
            />

            <TextControl
                autocomplete="off"
                help="Help text to explain the input."
                label="Enter Title"
                value={show_message_frontend}
                onChange={(show_message_frontend) => setAttributes({show_message_frontend})}
            />

            <hr/>

            <Typography
                label={__('Typography')}
                value={bio_typography}
                onChange={(val) => setAttributes({bio_typography: val})}
            />

            <Dimension
                label={__("Spacing", "gutenberg-users")}
                type="margin" responsive
                value={bio_spacing}
                onChange={(value) => {
                    setAttributes({bio_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'gutenberg-users')}
                color={bio_color}
                onChange={(bio_color) => setAttributes({bio_color})}
            />

        </PanelBody>
    );
}

export default UserBio;
