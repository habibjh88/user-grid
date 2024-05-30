import {__} from "@wordpress/i18n";
import {PanelBody, SelectControl} from "@wordpress/components";
import { GRID_LAYOUT_OPT} from "../../components/Constants";
import {  Alignment, Layouts, LayoutStyle, GridColumn } from "../../components/Components";

export default function ContentLayout(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        layout,
        grid_column,
        grid_alignment,
        grid_v_alignment,
        grid_height
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
                    grid: ['grid1', 'grid2', 'grid3', 'grid4', 'grid5', 'grid6', 'grid7', 'grid8'],
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

            <SelectControl
                label={__("Grid Height", "user-grid")}
                options={[
                    {value: 'height-auto', label: __('Auto', 'user-grid')},
                    {value: 'height-equal', label: __('Equal Height', 'user-grid')},
                ]}
                className="dowp-control-field label-inline dowp-expand"
                value={grid_height}
                onChange={(grid_height) => {
                    setAttributes({grid_height})
                    changeQuery()
                }}
            />

            <Alignment
                label={__("Text Align", "user-grid")}
                options={['left', 'center', 'right']}
                value={grid_alignment}
                responsive
                onChange={grid_alignment => {
                    setAttributes({grid_alignment})
                    changeQuery();
                }}
            />

            {latyouStyleDefault === 'list' &&
                <Alignment
                    label={__("V Alignment", "user-grid")}
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