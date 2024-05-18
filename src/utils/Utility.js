export const dynamicCols = (grid_column, default_grid_columns = []) => {
    if (!default_grid_columns) {
        default_grid_columns = {
            lg: '4',
            md: '6',
            sm: '12',
        }
    }
    const grid_column_desktop = grid_column.lg ?? default_grid_columns.lg;
    const grid_column_tab = grid_column.md ?? default_grid_columns.md;
    const grid_column_mobile = grid_column.sm ?? default_grid_columns.sm;

    return `dwp-col-md-${grid_column_desktop} dwp-col-sm-${grid_column_tab} dwp-col-xs-${grid_column_mobile}`;
}

export const extendClass = layout => {
    let classes = '';
    if (layout === 'list3') {
        classes += ' dowp-list2'
    }


    return classes;
}