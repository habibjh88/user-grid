const {__} = wp.i18n;
const icons = {};
const img_path = dowpParams.plugin_url + '/assets/images';

icons.usergrid_logo = `${img_path}/user-grid-logo.svg`;

icons.layout1 = <img src={`${img_path}/layouts/grid-1.svg`} alt={__('Grid Layout 1')}/>;
icons.layout2 = <img src={`${img_path}/layouts/list-1.svg`} alt={__('Grid Layout 2')}/>;
export default icons;