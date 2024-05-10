import {
    SelectControl,
    PanelBody,
    ButtonGroup,
    Button,
    TextControl, __experimentalHeading as Heading, __experimentalBorderControl as BorderControl
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";
import {UserGrid_COLOR_PALATE, NORMAL_HOVER} from "../../../components/Constants";

const {__} = wp.i18n;

function UserBioSettings(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        bio_typography,
        bio_spacing,
        bio_color,
        bio_visible_for,
        show_message_frontend,
        button_style_tab,
        button_color,
        button_background,
        button_border,
        button_color_hover,
        button_background_hover,
        button_border_hover,
        button_radius,
        button_padding
    } = attributes;

    return (
        <PanelBody title={__('User Biography', 'user-grid')} initialOpen={false}>

            <SelectControl
                label={__("Bio Visible For", "user-grid")}
                className="dowp-control-field label-inline"
                options={[
                    {value: 'all', label: 'All Users'},
                    {value: 'loggedin', label: 'Logged in Users'},
                ]}
                help={__("If you don't want to show this for non logged in users then choose 2nd option", "user-grid")}
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
                label={__("Spacing", "user-grid")}
                type="margin" responsive
                value={bio_spacing}
                onChange={(value) => {
                    setAttributes({bio_spacing: value})
                }}
            />

            <Color
                label={__('Color', 'user-grid')}
                color={bio_color}
                onChange={(bio_color) => setAttributes({bio_color})}
            />

            <Heading className="dowp-control-heading">{__("Button Style", "user-grid")}</Heading>

            <Dimension
                label={__("Button Border Radius", "user-grid")}
                className={`dowp-dimension-wrap`}
                type="borderRadius" responsive
                value={button_radius}
                onChange={(value) => {
                    setAttributes({button_radius: value})
                }}
            />

            <Dimension
                label={__("Button Padding", "user-grid")}
                type="padding" responsive
                value={button_padding}
                onChange={(value) => {
                    setAttributes({button_padding: value})
                }}
            />


            <ButtonGroup className="dowp-btn-group dowp-btn-group-state dowp-bottom-border-radius-none">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={button_style_tab === item.value}
                        isSecondary={button_style_tab !== item.value}
                        onClick={() => setAttributes({button_style_tab: item.value})}
                    >
                        {item.label}
                    </Button>
                ))}
            </ButtonGroup>

            {button_style_tab === 'normal' ?
                <div className="dowp-ground-control">
                    <Color
                        label={__('Button Color', 'the-post-grid')}
                        color={button_color}
                        onChange={(button_color) => setAttributes({button_color})}
                    />

                    <Color
                        label={__('Button Background', 'the-post-grid')}
                        color={button_background}
                        onChange={(button_background) => setAttributes({button_background})}
                    />

                    <BorderControl
                        colors={UserGrid_COLOR_PALATE}
                        value={button_border}
                        label={__("Button Border", "user-grid")}
                        onChange={(val) => {
                            const newVal = {openTpgBorder: 1, ...val}
                            setAttributes({button_border: newVal})
                        }}
                        withSlider
                    />
                </div>
                :
                <div className="dowp-ground-control">
                    <Color
                        label={__('Button Color - Hover', 'the-post-grid')}
                        color={button_color_hover}
                        onChange={(button_color_hover) => setAttributes({button_color_hover})}
                    />

                    <Color
                        label={__('Button Background - Hover', 'the-post-grid')}
                        color={button_background_hover}
                        onChange={(button_background_hover) => setAttributes({button_background_hover})}
                    />

                    <BorderControl
                        colors={UserGrid_COLOR_PALATE}
                        value={button_border_hover}
                        label={__("Button Border - Hover", "user-grid")}
                        onChange={(val) => {
                            const newVal = {openTpgBorder: 1, ...val}
                            setAttributes({button_border_hover: newVal})
                        }}
                        withSlider
                    />
                </div>

            }

        </PanelBody>
    );
}

export default UserBioSettings;
