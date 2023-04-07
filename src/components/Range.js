const { RangeControl, Button } = wp.components;

import './scss/rangeDevice.scss'

function Range( props ) {
    const { label, value: data, onChange, min, max, step, reset } = props;
    const dataAttributes = { min, max, step };

    const setSettings = ( val ) => {
        onChange( val );
    };

    return (
        <div className="gtusers-control-field gtusers-cf-range-wrap">
            { label && (
                <div className="gtusers-cf-head">
                    <span className="gtusers-label">{ label }</span>
                </div>
            ) }
            <div className="gtusers-cf-body">
                <RangeControl
                    value={ data }
                    onChange={ ( val ) => {
                        setSettings( val )
                    } }
                    { ...dataAttributes }
                />

                { (reset && data) ? <Button
                    isSmall
                    className="gtusers-undo-btn"
                    icon="image-rotate"
                    onClick={ () => onChange( null ) }
                ></Button> : ''
                }
            </div>
        </div>
    );
}

export default Range;
