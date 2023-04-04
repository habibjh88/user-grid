import TPGColumn from "../../components/TPGColumn";
import {__experimentalHeading as Heading} from '@wordpress/components';
import {SelectControl, PanelBody} from "@wordpress/components";
import RangeDevice from "../../components/RangeDevice";

const {__} = wp.i18n;
import {
    GRID_STYLE,
    GRID_LAYOUT_OPT,
    LIST_LAYOUT_OPT,
    GRID_HOVER_LAYOUT_OPT,
    SLIDER_LAYOUT_OPT, RTTPG_IS_PRO
} from "../../components/Constants";
import Alignment from "../../components/Alignment";
import Layouts from "../../components/Styles";

function LayoutController(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        prefix,
        grid_column,
        grid_layout_style,
        ignore_sticky_posts,
        full_wrapper_align,
        list_layout_alignment,
        slider_column,
        middle_border,
        layout_vertical_align,
        offset_img_position
    } = attributes;

    let postLayout = prefix + "_layout";
    let layoutOptions = GRID_LAYOUT_OPT;

    if (prefix === 'list') {
        layoutOptions = LIST_LAYOUT_OPT;
    } else if (prefix === 'grid_hover') {
        layoutOptions = GRID_HOVER_LAYOUT_OPT;
    } else if (prefix === 'slider') {
        layoutOptions = SLIDER_LAYOUT_OPT;
    }

    const excludeColumn = [
        'grid-layout5', 'grid-layout5-2', 'grid-layout6', 'grid-layout6-2',
        'list-layout2', 'list-layout2-2', 'list-layout3', 'list-layout3-2', 'list-layout4',
        'grid_hover-layout5', 'grid_hover-layout5-2', 'grid_hover-layout6', 'grid_hover-layout6-2',
        'grid_hover-layout7', 'grid_hover-layout7-2', 'grid_hover-layout8', 'grid_hover-layout9', 'grid_hover-layout9-2',
    ];

    const excludeGridyStyle = [
        'grid-layout2', 'grid-layout5', 'grid-layout5-2', 'grid-layout6', 'grid-layout6-2', 'grid-layout7', 'grid-layout7-2',
    ];

    const excludeSliderColumn = ['slider-layout10', 'slider-layout11'];

    return (
        <PanelBody title={__('Layout', 'the-post-grid')} initialOpen={true}>
            <Layouts
                value={attributes[postLayout]}
                onChange={val => props.changeLayout(val)}
                options={layoutOptions}
            />

            <Heading className="rttpg-control-heading">{__("Layout Options:", "the-post-grid")}</Heading>

            {['grid-layout5', 'grid-layout5-2', 'list-layout2', 'list-layout2-2', 'list-layout3', 'list-layout3-2'].includes(attributes[postLayout]) &&
                <SelectControl
                    label={__('Offset Image Position', 'the-post-grid')}
                    className="rttpg-control-field label-inline"
                    value={offset_img_position}
                    options={[
                        {value: 'offset-image-left', label: __('Left (Default)', 'the-post-grid')},
                        {value: 'offset-image-right', label: __('Right', 'the-post-grid')},
                    ]}
                    onChange={(offset_img_position) => {
                        setAttributes({offset_img_position})
                    }}
                />
            }

            {['grid-layout6', 'grid-layout6-2'].includes(attributes[postLayout]) &&
                <SelectControl
                    label={__('Middle Border?', 'the-post-grid')}
                    className="rttpg-control-field label-inline"
                    value={middle_border}
                    options={[
                        {value: 'yes', label: __('Yes', 'the-post-grid')},
                        {value: 'no', label: __('No', 'the-post-grid')},
                    ]}
                    onChange={(middle_border) => {
                        setAttributes({middle_border})
                    }}
                />
            }

            {prefix !== 'slider' &&
                <>
                    {!excludeColumn.includes(attributes[postLayout]) &&
                        <RangeDevice
                            label={__('Grid Column', 'the-post-grid')}
                            responsive={true}
                            value={grid_column}
                            min={1}
                            max={6}
                            step={1}
                            units={false}
                            onChange={(val) => {
                                setAttributes({grid_column: val})
                            }}
                        />
                    }
                    <small
                        className="rttpg-help">{__("NB. By default grid-colum comes from layout", "the-post-grid")}</small>
                </>
            }

            {prefix === 'slider' && !excludeSliderColumn.includes(attributes[postLayout]) &&
                <TPGColumn
                    label={__("Choose Slider Column", "the-post-grid")}
                    className="rttpg-control-field"
                    value={slider_column}
                    onChange={(slider_column) => {
                        setAttributes({slider_column})
                    }}
                    changeQuery={changeQuery}
                />
            }

            {(!excludeGridyStyle.includes(attributes[postLayout]) && 'grid' === prefix) &&
                <SelectControl
                    label={__('Layout Style', 'the-post-grid')}
                    className="rttpg-control-field label-inline rttpg-expand"
                    value={grid_layout_style}
                    options={GRID_STYLE}
                    onChange={(grid_layout_style) => {
                        setAttributes({grid_layout_style})
                    }}
                />
            }

            {grid_layout_style === 'masonry' &&
                <small className="rttpg-help">
                    {__("NB. Masonry will work only the front-end", "the-post-grid")}
                </small>
            }

            {RTTPG_IS_PRO === 'rttpg-is-pro' &&
                <p className="rttpg-help">{__("NB. Please upgrade to pro for masonry layout", "the-post-grid")}</p>}

            {grid_layout_style === 'tpg-full-height' &&
                <small className="rttpg-help">
                    {__('NB. Then Equal height will appear if you use card border ', 'the-post-grid')}
                </small>
            }

            {'list' === prefix && ['list-layout1', 'list-layout5'].includes(attributes[postLayout]) &&
                <SelectControl
                    label={__('Vertical Alignment', 'the-post-grid')}
                    className="rttpg-control-field label-inline rttpg-expand"
                    value={list_layout_alignment}
                    options={[
                        {value: '', label: __('Default', 'the-post-grid')},
                        {value: 'flex-start', label: __('Start', 'the-post-grid')},
                        {value: 'center', label: __('Center', 'the-post-grid')},
                        {value: 'flex-end', label: __('End', 'the-post-grid')},
                    ]}
                    onChange={(list_layout_alignment) => {
                        setAttributes({list_layout_alignment})
                    }}
                />
            }

            {!(['grid-layout7', 'slider-layout4'].includes(attributes[postLayout]) && prefix === 'list') &&
                <Alignment
                    label={__("Text Align", "the-post-grid")}
                    value={full_wrapper_align}
                    responsive={true}
                    options={['left', 'center', 'right']}
                    onChange={val => setAttributes({full_wrapper_align: val})}
                />
            }

            {(['grid_hover-layout3'].includes(attributes[postLayout])) &&
                <SelectControl
                    label={__('Vertical Align', 'the-post-grid')}
                    className="rttpg-control-field label-inline"
                    value={layout_vertical_align}
                    options={[
                        {value: '', label: __('Default', 'the-post-grid')},
                        {value: 'flex-start', label: __('Top', 'the-post-grid')},
                        {value: 'center', label: __('Center', 'the-post-grid')},
                        {value: 'flex-end', label: __('Bottom', 'the-post-grid')},
                        {value: 'space-between', label: __('Space Between', 'the-post-grid')},
                    ]}
                    onChange={(layout_vertical_align) => {
                        setAttributes({layout_vertical_align})
                    }}
                />
            }
        </PanelBody>
    );
}

export default LayoutController;
