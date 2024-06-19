const {useState, useEffect} = wp.element;
const {BaseControl, SelectControl, Button} = wp.components;

export default function CustomSelect(props) {
    const {label, value, onChange, options = []} = props;

    const hasPro = dowpParams.hasPro;
    const setSettings = (event) => {
        onChange(event.target.value);
    }

    return (

        <div className="dowp-control-field components-base-control dowp-select-wrap">
            <div className="dowp-cf-head">
                <span className="dowp-label">{label}</span>
            </div>

            <div className="dowp-cf-body">
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
