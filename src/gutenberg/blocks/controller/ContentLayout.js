import {__} from "@wordpress/i18n";
import {PanelBody} from "@wordpress/components";
import Alignment from "../../components/Alignment";
import Layouts from "../../components/Styles";
import {GRID_LAYOUT_OPT} from "../../components/Constants";
import LayoutStyle from "../../components/LayoutStyle";
import GridColumn from "../../components/GridColumn";

export default function ContentLayout(props) {
    const {attributes, setAttributes, changeQuery, userData} = props.data;

    //All attribute
    const {
        layout,
        grid_column,
        grid_alignment,
        grid_v_alignment,
    } = attributes;

    let latyouStyleDefault = 'grid';
    if(layout) {
        latyouStyleDefault = layout.indexOf('list') != '-1' ? 'list' : latyouStyleDefault
    }

    return (
        <PanelBody title={__('layout', 'user-grid')} initialOpen={true}>


            <Layouts
                value={latyouStyleDefault}
                onChange={layout_style => setAttributes({layout_style})}
                options={GRID_LAYOUT_OPT}
            />

            <LayoutStyle
                attributes={attributes}
                value={layout}
                options={{
                    grid: ['grid1', 'grid2', 'grid3', 'grid4'],
                    list: ['list1', 'list2', 'list3']
                }}
                onChange={layout => {
                    setAttributes({layout});
                    changeQuery();
                }}
            />

            <GridColumn
                label={__("Grid Column", "user-grid")}
                className="dowp-control-field"
                value={grid_column}
                onChange={(grid_column) => {
                    setAttributes({grid_column})
                }}
                colStyle="grid"
                changeQuery={changeQuery}
            />


            <Alignment
                label={__("Alignment", "user-grid")}
                options={['left', 'center', 'right']}
                value={grid_alignment}
                responsive
                onChange={grid_alignment => setAttributes({grid_alignment})}
            />

            {latyouStyleDefault === 'list' &&
                <Alignment
                    label={__("Vertical Alignment", "user-grid")}
                    options={['flex-start', 'center', 'flex-end']}
                    direction="vertical"
                    value={grid_v_alignment}
                    responsive
                    onChange={grid_v_alignment => setAttributes({grid_v_alignment})}
                />
            }
        </PanelBody>
    );
}