import {LyaoutIcons} from "../utils/LyaoutIcons";
import "./scss/LayoutStyle.scss";
const LayoutStyle = (props) => {

    const {value, responsive, onChange, label, attributes, options} = props;
    const _filterValue = () => {
        return value ?? '';
    }
    const setSettings = (val) => {
        if (val === '') {
            return;
        }
        onChange(val);
    }

    const {layout_style} = attributes;

    let defaultData = options.grid;

    if ('list' === layout_style) {
        defaultData = options.list;
    }

    if ('slider' === layout_style) {
        defaultData = options.slider;
    }

    const freeLayout = ['grid1', 'grid2', 'grid3', 'list1', 'list2', 'list3', 'slider1'];

    return (
        <div className="dowp-control-field components-base-control dowp-cf-layout-style">

            {(label || responsive) && (
                <div className="dowp-cf-head">
                    {label && (
                        <span className="dowp-label">{label}</span>
                    )}
                </div>
            )}

            <div className="dowp-cf-body dowp-btn-group">

                {defaultData.map((data, index) => {
                    return (
                        <button className={(_filterValue() == data ? 'active' : '') + ' dowp-button ' + ( freeLayout.includes(data) ? '' : 'pro-layout')}
                                key={index}
                                onClick={() => {
                                    if(! dowpParams.hasPro && ! freeLayout.includes(data) ) {
                                        alert('pro required');
                                        return false;
                                    }
                                    setSettings(_filterValue() == data ? '' : data);
                                }}>
                            <LyaoutIcons styleLayout={data} layout_style={layout_style}/>
                        </button>
                    )
                })}

            </div>
        </div>
    )
}

export default LayoutStyle;