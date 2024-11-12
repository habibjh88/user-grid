const {__} = wp.i18n;
const icons = {};
const img_path = usgrParams.plugin_url + '/assets/images';

icons.usergrid_logo = `${img_path}/user-grid-logo.svg`;

icons.layout1 = <img src={`${img_path}/layouts/grid.svg`} alt={__('Grid Layout')}/>;
icons.layout2 = <img src={`${img_path}/layouts/list.svg`} alt={__('Grid Layout')}/>;
icons.layout3 = <img src={`${img_path}/layouts/slider.svg`} alt={__('Slider Layout')}/>;
export default icons;