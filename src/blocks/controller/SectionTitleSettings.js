const {__} = wp.i18n;
import "flatpickr/dist/themes/light.css";
import {SelectControl, TextControl, PanelBody} from "@wordpress/components";
import {SECTION_TITLE_STYLE, SECTION_TITLE_SOURCE, HEADING} from "../../components/Constants";

function SectionTitleSettings(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        section_title_style,
        section_title_source,
        section_title_text,
        section_title_tag,
        show_section_title
    } = attributes;

    if (show_section_title !== 'show') {
        return '';
    }
    return (
        <PanelBody title={__('Section Title', 'the-post-grid')} initialOpen={false}>
            <SelectControl
                label={__('Title Style', 'the-post-grid')}
                className="rttpg-control-field label-inline"
                value={section_title_style}
                options={SECTION_TITLE_STYLE}
                onChange={(section_title_style) => setAttributes({section_title_style})}
            />
            <SelectControl
                label={__('Title Source', 'the-post-grid')}
                className="rttpg-control-field label-inline"
                value={section_title_source}
                options={SECTION_TITLE_SOURCE}
                onChange={(section_title_source) => setAttributes({section_title_source})}
            />
            {'custom_title' === section_title_source && (<TextControl
                autocomplete="off"
                help="Help text to explain the input."
                label="Enter Title"
                value={section_title_text}
                onChange={(section_title_text) => setAttributes({section_title_text})}
            />)}
            <SelectControl
                label={__('Title Tags', 'the-post-grid')}
                className="rttpg-control-field label-inline"
                options={HEADING}
                value={section_title_tag}
                onChange={(section_title_tag) => setAttributes({section_title_tag})}
            />
        </PanelBody>
    );
}

export default SectionTitleSettings;
