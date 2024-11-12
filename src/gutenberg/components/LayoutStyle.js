import {LyaoutIcons} from "../utils/LyaoutIcons";
import "./scss/LayoutStyle.scss";
import cogoToast from "cogo-toast";
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

    const hasPro = usgrParams.hasPro ? 'has-pro' : 'need-pro';

    return (
        <div className={`usgr-control-field components-base-control usgr-cf-layout-style ${hasPro}`}>

            {(label || responsive) && (
                <div className="usgr-cf-head">
                    {label && (
                        <span className="usgr-label">{label}</span>
                    )}
                </div>
            )}

            <div className="usgr-cf-body usgr-btn-group">

                {defaultData.map((data, index) => {
                    return (
                        <button className={(_filterValue() == data ? 'active' : '') + ' usgr-button ' + ( freeLayout.includes(data) ? '' : 'pro-layout')}
                                key={index}
                                onClick={() => {
                                    if(! usgrParams.hasPro && ! freeLayout.includes(data) ) {
                                        // alert('pro required');
                                        cogoToast.warn('Upgrade to Pro for unlock more layout..', {position: 'top-right'});
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