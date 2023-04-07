import { SelectControl } from "@wordpress/components";

const { __ } = wp.i18n;

import './scss/rangeDevice.scss'
import { COL_OPTIONS, COL_OPTIONS_GRID } from "./Constants"
import { useState, useEffect } from "react";

function TPGColumn( props ) {
    const { label, value: data, onChange, className, changeQuery, colStyle = "" } = props;

    const setSettings = ( device, val ) => {
        const newData = JSON.parse( JSON.stringify( data ) );
        newData[device] = val;
        onChange( newData );
    };

    const GRID_CLOUMN = colStyle === 'grid' ? COL_OPTIONS_GRID : COL_OPTIONS;

    return (
        <div className={ `gtusers-column-group ${ className }` }>
            { label && (
                <div className="gtusers-cf-head">
                    <span className="gtusers-label">{ label }</span>
                </div>
            ) }

            <div className="gtusers-column-group-inner">
                <SelectControl
                    label={ __( 'Desktop', 'gutenberg-users' ) }
                    className="gtusers-control-field"
                    value={ data.lg || '' }
                    options={ GRID_CLOUMN }
                    onChange={ ( val ) => {
                        setSettings( 'lg', val );
                        changeQuery();
                    } }
                />

                <SelectControl
                    label={ __( 'Tablet', 'gutenberg-users' ) }
                    className="gtusers-control-field"
                    value={ data.md || '' }
                    options={ GRID_CLOUMN }
                    onChange={ ( val ) => setSettings( "md", val ) }
                />

                <SelectControl
                    label={ __( 'Mobile', 'gutenberg-users' ) }
                    className="gtusers-control-field"
                    value={ data.sm || '' }
                    options={ GRID_CLOUMN }
                    onChange={ ( val ) => setSettings( "sm", val ) }
                />
            </div>

        </div>
    );
}

export default TPGColumn;
