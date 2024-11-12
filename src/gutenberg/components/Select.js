import Devices from "./Devices";

const {useState, useEffect} = wp.element;
const {BaseControl, SelectControl, Button} = wp.components;

function Select(props) {
    const {label, value, onChange, responsive, options = []} = props;
    const [device, setDevice] = useState(() => window.usgrDevice || 'lg');

    const defaultData = '';

    const setSettings = (val) => {
        const newData = JSON.parse(JSON.stringify(value));
        newData[device] = val;
        onChange(newData);
    }

    return (

        <div className="usgr-control-field components-base-control">
            <div className="usgr-cf-head">
                <span className="usgr-label">{label}</span>
                {responsive && <Devices device={device} onChange={_device => {
                    setDevice(_device);
                    const newData = JSON.parse(JSON.stringify(value));
                    if (!newData[_device]) {
                        newData[_device] = defaultData;
                        onChange(newData);
                    }
                }}/>}
            </div>

            <div className="usgr-cf-body">
                <SelectControl
                    value={value[device]}
                    options={options}
                    onChange={(val) => setSettings(val)}
                />
            </div>

        </div>

    )
}

export default Select;