const {useState, useEffect} = wp.element;
const {BaseControl, SelectControl, Button} = wp.components;

export default function CustomSelect(props) {
    const {label, value, onChange, options = []} = props;

    const hasPro = usgrParams.hasPro;
    const setSettings = (event) => {
        onChange(event.target.value);
    }

    return (

        <div className="usgr-control-field components-base-control usgr-select-wrap">
            <div className="usgr-cf-head">
                <span className="usgr-label">{label}</span>
            </div>

            <div className="usgr-cf-body">
                <select className="components-select" value={value}
                        onChange={(event) => setSettings(event)}>
                    {options.map((option) => (
                        <option key={option.value} value={option.value} disabled={!hasPro ? option.disabled : false}>
                            {option.label}
                        </option>
                    ))}
                </select>
            </div>

        </div>

    )
}
