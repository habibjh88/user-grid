import {
    __experimentalBorderControl as BorderControl,
    Button,
    ToggleControl,
    SelectControl,
    PanelBody,
    Dropdown
} from '@wordpress/components';
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";
import RangeDevice from "../../../components/RangeDevice";

const {__} = wp.i18n;
import {TPG_COLOR_PALATE} from "../../../components/Constants";

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
        <PanelBody title={__('Count Style', 'the-post-grid')} initialOpen={false}>
            <ToggleControl
                label={__("Visibility", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={count_visibility}
                onChange={(count_visibility) => setAttributes({count_visibility: count_visibility ? 'show' : ''})}
            />
            <ToggleControl
                label={__("Show Bracket", "the-post-grid")}
                className="rttpg-toggle-control-field"
                checked={show_bracket}
                onChange={(show_bracket) => setAttributes({show_bracket: show_bracket ? 'show' : ''})}
            />
            <Typography
                label={__('Typography')}
                value={count_typography}
                onChange={(val) => setAttributes({count_typography: val})}
            />

            <SelectControl
                label={__("Count Positioin", "the-post-grid")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={[
                    {value: 'thumb', label: __('With Image', 'the-post-grid')},
                    {value: 'title', label: __('With Title', 'the-post-grid')}
                ]}
                value={count_position}
                onChange={(count_position) => setAttributes({count_position})}
            />


            {count_position === 'thumb' &&
                <div className="rttpg-control-field rttpg-cf-typography-wrap">
                    <span className="rttpg-label">{__('Change Count Position')}</span>
                    <div className="rttpg-typography">
                        <Dropdown
                            className="rttpg-typography-dropdown-icon"
                            contentClassName="rttpg-components-popover rttpg-cp-typography-content"
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

                                <div className="rttpg-typography-content">

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
                label={__("Count Padding", "the-post-grid")}
                type="margin" responsive
                value={count_padding}
                onChange={(value) => {
                    setAttributes({count_padding: value})
                }}
            />

            <Color
                label={__('Category Color', 'the-post-grid')}
                color={count_color}
                onChange={(count_color) => setAttributes({count_color})}
            />

            <Color
                label={__('Category Color', 'the-post-grid')}
                color={count_bg}
                onChange={(count_bg) => setAttributes({count_bg})}
            />

            <BorderControl
                colors={TPG_COLOR_PALATE}
                value={count_border}
                label={__("Count Border", "the-post-grid")}
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
