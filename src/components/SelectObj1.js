import Devices from "./Devices";

const {useState, useEffect} = wp.element;
const {BaseControl, SelectControl, Button} = wp.components;

import './scss/SelectObj1.scss'

function SelectObj1(props) {
    const {label, value, onChange, responsive, name, options} = props;
    const [device, setDevice] = useState(() => window.dowpDevice || 'lg');
    const defaultData = {
        [device]: ''
    };

    const setSettings = (val) => {
        const newData = JSON.parse(JSON.stringify(value));
        if (responsive) {
            newData[name][device] = val;
        } else {
            newData[name] = val;
        }
        //newData[device][name] = val;
        onChange(newData);
    }


    return (
        <div className="dowp-control-field dowp-cf-bg-property">
            <div className="dowp-cf-head">
                <span className="dowp-label">{label}</span>
                {responsive && <Devices device={device} onChange={_device => {
                    setDevice(_device);
                    const newData = JSON.parse(JSON.stringify(value));
                    if (!newData[name]) {
                        newData[name] = defaultData;
                        onChange(newData);
                    }
                }}/>}
            </div>
            <div className="dowp-cf-body">
                <SelectControl
                    value={responsive ? value[name][device] : value[name]}
                    options={options}
                    onChange={(val) => setSettings(val)}
                />
            </div>
        </div>

    )
}

export default SelectObj1;