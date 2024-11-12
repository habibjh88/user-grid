/**
 * Make Dynamic column Class
 *
 * @param grid_column
 * @param default_grid_columns
 * @returns {`usgr-col-md-4 usgr-col-sm-6 usgr-col-xs-${string|[]|boolean|*}`}
 */
export const dynamicCols = (grid_column, default_grid_columns = []) => {
    if (default_grid_columns.length < 1) {
        default_grid_columns = {
            lg: '4',
            md: '6',
            sm: '12',
        }
    }

    const grid_column_desktop = grid_column.lg > 0 ? grid_column.lg : default_grid_columns.lg;
    const grid_column_tab = grid_column.md > 0 ? grid_column.md : default_grid_columns.md;
    const grid_column_mobile = grid_column.sm > 0 ? grid_column.sm : default_grid_columns.sm;
    return `usgr-col-md-${grid_column_desktop} usgr-col-sm-${grid_column_tab} usgr-col-xs-${grid_column_mobile}`;
}

/**
 * Extended class
 *
 * @param layout
 * @returns {string}
 */
export const extendClass = layout => {
    let classes = '';
    classes += layout === 'grid3' ? ' usgr-grid2' : '';
    classes += layout === 'list3' ? ' usgr-list2' : '';
    return classes;
}

/**
 * Layout Alignment
 *
 * @param grid_alignment
 * @returns {string}
 */
export const layoutAlign = (grid_alignment) => {
    let alignClass = '';
    for (const [device, value] of Object.entries(grid_alignment)) {
        if (!value) {
            continue;
        }
        alignClass += `${device}-${value} `;
    }
    return alignClass.trim();
}