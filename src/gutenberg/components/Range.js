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
        <div className="dowp-control-field components-base-control dowp-cf-range-wrap">
            { label && (
                <div className="dowp-cf-head">
                    <span className="dowp-label">{ label }</span>
                </div>
            ) }
            <div className="dowp-cf-body">
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
