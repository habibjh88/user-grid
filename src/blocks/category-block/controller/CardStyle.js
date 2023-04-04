
import {SelectControl, PanelBody} from "@wordpress/components";
import Color from "../../../components/Color";
import Typography from "../../../components/Typography";
import Dimension from "../../../components/Dimension";


const {__} = wp.i18n;
import {
    GRID_LAYOUT_OPT,
    LIST_LAYOUT_OPT,
    GRID_HOVER_LAYOUT_OPT,
    SLIDER_LAYOUT_OPT, PRINT_TAXONOMY, HEADING
} from "../../../components/Constants";

function CardStyle(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        cat_color,
        cat_tag,
        category_typography,
        cat_spacing,
        category_color_hover,

    } = attributes;

    return (
        <PanelBody title={__('Card Style', 'the-post-grid')} initialOpen={true}>


            <Dimension
                label={__("Category Spacing", "the-post-grid")}
                type="margin" responsive
                value={cat_spacing}
                onChange={(value) => {
                    setAttributes({cat_spacing: value})
                }}
            />



        </PanelBody>
    );
}

export default CardStyle;
