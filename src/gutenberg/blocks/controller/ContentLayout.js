import {__} from "@wordpress/i18n";

const {useEffect} = wp.element;
import {PanelBody, SelectControl, ToggleControl} from "@wordpress/components";
import {GRID_LAYOUT_OPT} from "../../components/Constants";
import {Alignment, Layouts, LayoutStyle, GridColumn} from "../../components/Components";
import {styleIcon} from "../../utils/LyaoutIcons";

const getKeysByPrefix = (obj, prefix) => {
    return Object.keys(obj).filter(key => key.startsWith(prefix));
};

// Create the final object with arrays of keys
export const DOWP_LAYOUT = {
    grid: getKeysByPrefix(styleIcon, 'grid'),
    list: getKeysByPrefix(styleIcon, 'list'),
};

export default function ContentLayout(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        layout,
        grid_column,
        dark_mode,
        layout_reverse,
        grid_alignment,
        grid_v_alignment,
        grid_height,
        layout_style,
    } = attributes;

    useEffect(function () {
        if (layout.indexOf('list') != '-1') {
            setAttributes({layout_style: 'list'})
        } else {
            setAttributes({layout_style: 'grid'})
        }
    }, [])

    return (
        <PanelBody title={__('Layout', 'user-grid')} initialOpen={true}>

            <Layouts
                value={layout_style}
                onChange={layout_style => setAttributes({layout_style})}
                options={GRID_LAYOUT_OPT}
            />

            <LayoutStyle
                attributes={attributes}
                value={layout}
                options={DOWP_LAYOUT}
                onChange={layout => {
                    setAttributes({layout});
                    changeQuery();
                }}
            />


            <ToggleControl
                label={__("Dark Mode?", "user-grid")}
                className="dowp-toggle-control-field"
                checked={dark_mode}
                onChange={(dark_mode) => {
                    setAttributes({dark_mode: dark_mode ? 'show' : ''});
                    changeQuery()
                }}
            />

            <ToggleControl
                label={__("Layout Reverse", "user-grid")}
                className="dowp-toggle-control-field"
                checked={layout_reverse}
                onChange={(layout_reverse) => {
                    setAttributes({layout_reverse: layout_reverse ? 'show' : ''});
                    changeQuery()
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

            {layout_style === 'list' &&
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