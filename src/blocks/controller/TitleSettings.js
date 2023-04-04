const {__} = wp.i18n;
import {SelectControl, PanelBody, __experimentalNumberControl as NumberControl} from "@wordpress/components";
import {HEADING, TITLE_VISIBILITY_STYLE, TITLE_POSITION} from "../../components/Constants";

function TitleSettings(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        title_tag,
        title_visibility_style,
        title_limit,
        title_limit_type,
        title_position,
        title_hover_underline,
        show_title
    } = attributes;

    if (show_title !== 'show') {
        return '';
    }

    let postLayout = prefix + "_layout";

    return (
        <PanelBody title={__('Post Title', 'the-post-grid')} initialOpen={false}>

            <SelectControl
                label={__('Title Tags', 'the-post-grid')}
                className="rttpg-control-field label-inline"
                options={HEADING}
                value={title_tag}
                onChange={(title_tag) => setAttributes({title_tag})}
            />

            <SelectControl
                label={__("Title Visibility Style", "the-post-grid")}
                className="rttpg-control-field label-inline"
                options={TITLE_VISIBILITY_STYLE}
                value={title_visibility_style}
                onChange={(title_visibility_style) => setAttributes({title_visibility_style})}
            />

            {title_visibility_style === 'custom' && (<NumberControl
                isShiftStepEnabled
                label={__("Title Length", "the-post-grid")}
                className="rttpg-control-field label-inline"
                max={100}
                min={0}
                placeholder="0"
                shiftStep={5}
                step="1"
                value={title_limit}
                onChange={(title_limit) => setAttributes({title_limit})}
            />)}

            {(title_limit > 0 && title_visibility_style === 'custom') && (<SelectControl
                label={__("Title Crop by", "the-post-grid")}
                className="rttpg-control-field label-inline"
                options={[
                    {value: 'word', label: __('Words', 'the-post-grid')},
                    {value: 'character', label: __('Characters', 'the-post-grid')}
                ]}
                value={title_limit_type}
                onChange={(title_limit_type) => setAttributes({title_limit_type})}
            />)}

            {['grid-layout1', 'grid-layout2', 'grid-layout3', 'grid-layout4', 'slider-layout1', 'slider-layout2', 'slider-layout3'].includes(attributes[postLayout]) &&
                <SelectControl
                    label={__("Title Position", "the-post-grid")}
                    className="rttpg-control-field label-inline"
                    options={TITLE_POSITION}
                    value={title_position}
                    onChange={(title_position) => setAttributes({title_position})}
                />
            }

            {/* TODO: title_position_hidden */}

            <SelectControl
                label={__("Title Hover Underline", "the-post-grid")}
                className="rttpg-control-field label-inline"
                options={[
                    {value: 'default', label: __('Default', 'the-post-grid')},
                    {value: 'enable', label: __('Enable', 'the-post-grid')},
                    {value: 'disable', label: __('Disable', 'the-post-grid')}
                ]}
                value={title_hover_underline}
                onChange={(title_hover_underline) => setAttributes({title_hover_underline})}
            />

        </PanelBody>

    );
}

export default TitleSettings;
