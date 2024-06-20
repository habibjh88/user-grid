import { SelectControl } from "@wordpress/components";

const { __ } = wp.i18n;

import './scss/rangeDevice.scss'
import { COL_OPTIONS, COL_OPTIONS_GRID } from "./Constants"

function GridColumn( props ) {
    const { label, value: data, onChange, className, changeQuery, colStyle = "", options } = props;

    const setSettings = ( device, val ) => {
        const newData = JSON.parse( JSON.stringify( data ) );
        newData[device] = val;
        onChange( newData );
        changeQuery();
    };

    return (
        <div className={ `dowp-column-group components-base-control ${ className }` }>
            { label && (
                <div className="dowp-cf-head">
                    <span className="dowp-label">{ label }</span>
                </div>
            ) }

            <div className="dowp-column-group-inner">
                <SelectControl
                    label={ __( 'Desktop', 'user-grid' ) }
                    className="dowp-control-field"
                    value={ data.lg || '' }
                    options={ options }
                    onChange={ ( val ) => {
                        setSettings( 'lg', val );
                    } }
                />

                <SelectControl
                    label={ __( 'Tablet', 'user-grid' ) }
                    className="dowp-control-field"
                    value={ data.md || '' }
                    options={ options }
                    onChange={ ( val ) => setSettings( "md", val ) }
                />

                <SelectControl
                    label={ __( 'Mobile', 'user-grid' ) }
                    className="dowp-control-field"
                    value={ data.sm || '' }
                    options={ options }
                    onChange={ ( val ) => setSettings( "sm", val ) }
                />
            </div>

        </div>
    );
}

export default GridColumn;
