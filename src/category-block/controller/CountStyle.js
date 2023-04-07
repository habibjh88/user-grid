import {
    __experimentalBorderControl as BorderControl,
    Button,
    ToggleControl,
    SelectControl,
    PanelBody,
    Dropdown
} from '@wordpress/components';
import Color from "../../../../../the-post-grid/src/components/Color";
import Typography from "../../../../../the-post-grid/src/components/Typography";
import Dimension from "../../../../../the-post-grid/src/components/Dimension";
import RangeDevice from "../../../../../the-post-grid/src/components/RangeDevice";

const {__} = wp.i18n;
import {TPG_COLOR_PALATE} from "../../../../../the-post-grid/src/components/Constants";

function CountStyle(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {
        count_typography,
        count_visibility,
        show_bracket,
        count_position,
        count_padding,
        count_color,
        count_bg,
        count_border,
        count_left_pos,
        count_top_pos,
        count_right_pos,
        count_bottom_pos,
    } = attributes;

    return (
        <PanelBody title={__('Count Style', 'gutenberg-users')} initialOpen={false}>
            <ToggleControl
                label={__("Visibility", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={count_visibility}
                onChange={(count_visibility) => setAttributes({count_visibility: count_visibility ? 'show' : ''})}
            />
            <ToggleControl
                label={__("Show Bracket", "gutenberg-users")}
                className="gtusers-toggle-control-field"
                checked={show_bracket}
                onChange={(show_bracket) => setAttributes({show_bracket: show_bracket ? 'show' : ''})}
            />
            <Typography
                label={__('Typography')}
                value={count_typography}
                onChange={(val) => setAttributes({count_typography: val})}
            />

            <SelectControl
                label={__("Count Positioin", "gutenberg-users")}
                className="gtusers-control-field label-inline gtusers-expand"
                options={[
                    {value: 'thumb', label: __('With Image', 'gutenberg-users')},
                    {value: 'title', label: __('With Title', 'gutenberg-users')}
                ]}
                value={count_position}
                onChange={(count_position) => setAttributes({count_position})}
            />


            {count_position === 'thumb' &&
                <div className="gtusers-control-field gtusers-cf-typography-wrap">
                    <span className="gtusers-label">{__('Change Count Position')}</span>
                    <div className="gtusers-typography">
                        <Dropdown
                            className="gtusers-typography-dropdown-icon"
                            contentClassName="gtusers-components-popover gtusers-cp-typography-content"
                            position="bottom right"
                            renderToggle={({isOpen, onToggle}) => (
                                <Button
                                    isSmall
                                    onClick={onToggle}
                                    aria-expanded={isOpen}
                                    icon="edit-page"
                                ></Button>
                            )}

                            renderContent={() => (

                                <div className="gtusers-typography-content">

                                    <RangeDevice
                                        label={__('Left Position')}
                                        responsive={true}
                                        value={count_left_pos}
                                        min={-300}
                                        max={300}
                                        step={1}
                                        onChange={(val) => setAttributes({count_left_pos: val})}
                                    />

                                    <RangeDevice
                                        label={__('Top Position')}
                                        responsive={true}
                                        value={count_top_pos}
                                        min={-300}
                                        max={300}
                                        step={1}
                                        onChange={(val) => setAttributes({count_top_pos: val})}
                                    />

                                    <RangeDevice
                                        label={__('Right Position')}
                                        responsive={true}
                                        value={count_right_pos}
                                        min={-300}
                                        max={300}
                                        step={1}
                                        onChange={(val) => setAttributes({count_right_pos: val})}
                                    />

                                    <RangeDevice
                                        label={__('Bottom Position')}
                                        responsive={true}
                                        value={count_bottom_pos}
                                        min={-300}
                                        max={300}
                                        step={1}
                                        onChange={(val) => setAttributes({count_bottom_pos: val})}
                                    />


                                </div>
                            )}


                        />

                    </div>


                </div>
            }

            <Dimension
                label={__("Count Padding", "gutenberg-users")}
                type="margin" responsive
                value={count_padding}
                onChange={(value) => {
                    setAttributes({count_padding: value})
                }}
            />

            <Color
                label={__('Category Color', 'gutenberg-users')}
                color={count_color}
                onChange={(count_color) => setAttributes({count_color})}
            />

            <Color
                label={__('Category Color', 'gutenberg-users')}
                color={count_bg}
                onChange={(count_bg) => setAttributes({count_bg})}
            />

            <BorderControl
                colors={TPG_COLOR_PALATE}
                value={count_border}
                label={__("Count Border", "gutenberg-users")}
                onChange={(val) => {
                    const newVal = {openTpgBorder: 1, ...val}
                    setAttributes({count_border: newVal})
                }}
                withSlider
            />

        </PanelBody>
    );
}

export default CountStyle;
