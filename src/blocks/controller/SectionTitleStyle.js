const {__} = wp.i18n;
import {__experimentalNumberControl as NumberControl, PanelBody} from "@wordpress/components";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import Alignment from "../../components/Alignment";

function SectionTitleStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        show_section_title,
        filter_btn_style,
        section_title_alignment,
        section_title_margin,
        section_title_typography,
        section_title_color,
        section_title_bg_color,
        section_title_dot_color,
        section_title_style,
        section_title_line_color,
        section_title_line_width,
        section_title_line_spacing
    } = attributes;

    if (show_section_title !== 'show') {
        return '';
    }

    return (
        <PanelBody title={__('Section Title', 'the-post-grid')} initialOpen={true}>

            {filter_btn_style !== 'carousel' &&
                <Alignment
                    label={__("Alignment", "the-post-grid")}
                    options={['left', 'center', 'right']}
                    value={section_title_alignment}
                    onChange={section_title_alignment => setAttributes({section_title_alignment})}
                />
            }

            <Dimension
                label={__("Margin", "the-post-grid")}
                isLinked={false}
                type="margin" responsive
                value={section_title_margin}
                onChange={(value) => {
                    setAttributes({section_title_margin: value})
                }}
            />

            <Typography
                label={__('Typography', 'the-post-grid')}
                value={section_title_typography}
                onChange={(val) => setAttributes({section_title_typography: val})}
            />

            <Color
                label={__('Title Color', 'the-post-grid')}
                color={section_title_color}
                onChange={(section_title_color) => setAttributes({section_title_color})}
            />

            {['style2', 'style3'].includes(section_title_style) &&
                <Color
                    label={__('Title Background Color', 'the-post-grid')}
                    color={section_title_bg_color}
                    onChange={(section_title_bg_color) => setAttributes({section_title_bg_color})}
                />
            }

            {['style1', 'style4'].includes(section_title_style) &&
                <Color
                    label={__('Dot / Bar Color', 'the-post-grid')}
                    color={section_title_dot_color}
                    onChange={(section_title_dot_color) => setAttributes({section_title_dot_color})}
                />
            }

            {section_title_style !== 'default' &&
                <Color
                    label={__('Line / Border Color', 'the-post-grid')}
                    color={section_title_line_color}
                    onChange={(section_title_line_color) => setAttributes({section_title_line_color})}
                />
            }

            {['style4'].includes(section_title_style) &&
                <>
                    <NumberControl
                        isShiftStepEnabled
                        label={__("Line Width", "the-post-grid")}
                        max={1200}
                        min={1}
                        value={section_title_line_width}
                        onChange={(section_title_line_width) => {
                            setAttributes({section_title_line_width})
                        }}
                        placeholder={__("Max 1200", "the-post-grid")}
                        shiftStep={1}
                        step="1"
                        className="rttpg-control-field label-inline"
                    />
                    <NumberControl
                        isShiftStepEnabled
                        label={__("Line Spacing", "the-post-grid")}
                        max={300}
                        min={-300}
                        value={section_title_line_spacing}
                        onChange={(section_title_line_spacing) => {
                            setAttributes({section_title_line_spacing})
                        }}
                        placeholder={__("-300 to 300", "the-post-grid")}
                        shiftStep={1}
                        step="1"
                        className="rttpg-control-field label-inline"
                    />
                </>
            }

        </PanelBody>
    );
}

export default SectionTitleStyle;
