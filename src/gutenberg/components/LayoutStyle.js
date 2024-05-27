import LyaoutItems from "../utils/LyaoutItems";
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

    const proLayout = ['grid4', 'list4'];

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
                        <button className={(_filterValue() == data ? 'active' : '') + ' dowp-button ' + (proLayout.includes(data) ? 'pro-layout' : '')}
                                key={index}
                                onClick={() => {
                                    if(! dowpParams.hasPro && proLayout.includes(data) ) {
                                        alert('pro required');
                                        return false;
                                    }
                                    setSettings(_filterValue() == data ? '' : data);
                                }}>
                            <LyaoutItems styleLayout={data}/>
                        </button>
                    )
                })}

            </div>
        </div>
    )
}

export default LayoutStyle;