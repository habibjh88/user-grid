import ResetButton from "./ResetButton";

const { RangeControl, Button } = wp.components;

import './scss/rangeDevice.scss'

function Range( props ) {
    const { label, value: data, onChange, min, max, step, reset } = props;
    const dataAttributes = { min, max, step };

    const setSettings = ( val ) => {
        onChange( val );
    };

    return (
        <div className="usgr-control-field components-base-control usgr-cf-range-wrap">
            { label && (
                <div className="usgr-cf-head">
                    <span className="usgr-label">{ label }</span>
                </div>
            ) }
            <div className="usgr-cf-body">
                <RangeControl
                    value={ data }
                    onChange={ ( val ) => {
                        setSettings( val )
                    } }
                    { ...dataAttributes }
                />

                { (reset && data) ? <ResetButton onChange={() => onChange(null)}/>: ''
                }
            </div>
        </div>
    );
}

export default Range;
