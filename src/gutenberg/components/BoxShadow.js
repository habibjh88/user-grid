const { __ } = wp.i18n;
const { useState, useEffect } = wp.element;
const { Dropdown, Button, SelectControl, RangeControl, ToggleControl } = wp.components;

import Range from "./Range";

import Color from "./Color";
import "./scss/boxshadow.scss";

function BoxShadow( props ) {
    const { label, value: data, onChange, transition } = props;

    const setSettings = ( val, type, property = null ) => {
        const newData = JSON.parse( JSON.stringify( data ) );
        if ( type === 'width' ) {
            newData[type][property] = val;
        } else {
            newData[type] = val;
        }
        onChange( newData );
    };

    return (
        <div className="dowp-control-field components-base-control dowp-cf-typography-wrap">

            { label && (
                <span className="dowp-label">{ label }</span>
            ) }

            <div className="dowp-typography">

                <Dropdown
                    className="dowp-typography-dropdown-icon"
                    contentClassName="dowp-components-popover dowp-cp-typography-content"
                    position="bottom right"
                    renderToggle={ ( { isOpen, onToggle } ) => (
                        <Button
                            isSmall
                            onClick={ onToggle }
                            aria-expanded={ isOpen }
                        >
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.3511 0.969238H8.25512C6.71965 0.969238 5.47005 2.21884 5.47005 3.75484V6.30257H2.92232C1.38632 6.30257 0.136719 7.55217 0.136719 9.08817V14.1842C0.136719 15.7196 1.38632 16.9692 2.92232 16.9692H8.01832C9.55379 16.9692 10.8034 15.7196 10.8034 14.1836V11.6359H13.3511C14.8871 11.6359 16.1367 10.3863 16.1367 8.85031V3.75484C16.1367 2.21884 14.8871 0.969238 13.3511 0.969238ZM9.73672 14.1836C9.73672 15.1319 8.96605 15.9026 8.01779 15.9026H2.92232C1.97405 15.9026 1.20339 15.1319 1.20339 14.1836V9.08764C1.20339 8.13991 1.97405 7.36924 2.92232 7.36924H5.47005V8.85031C5.47005 10.3863 6.71965 11.6359 8.25565 11.6359H9.73672V14.1836ZM9.73672 10.5692H8.25565C7.30739 10.5692 6.53672 9.79857 6.53672 8.85031V7.36924H8.01779C8.96605 7.36924 9.73672 8.13991 9.73672 9.08817V10.5692ZM15.0701 8.85031C15.0701 9.79857 14.2994 10.5692 13.3511 10.5692H10.8034V9.08817C10.8034 7.55217 9.55379 6.30257 8.01779 6.30257H6.53672V3.75484C6.53672 2.80657 7.30739 2.03591 8.25565 2.03591H13.3517C14.2994 2.03591 15.0701 2.80657 15.0701 3.75484V8.85031Z" fill="black"/>
                            </svg>
                        </Button>
                    ) }

                    renderContent={ () => (
                        <div className="dowp-typography-content">
                            <Color
                                label={ __( "Color" ) }
                                color={ data['color'] }
                                onChange={ ( val ) => setSettings( val, 'color' ) }
                            />
                            <Range
                                label={ __( "Horizontal Offset" ) }
                                reset={ true }
                                value={ data['width']["top"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'top' ) }
                                min={ 0 }
                                max={ 100 }
                            />
                            <Range
                                label={ __( "Vertical Offset" ) }
                                reset={ true }
                                value={ data['width']["right"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'right' ) }
                                min={ 0 }
                                max={ 100 }
                            />
                            <Range
                                label={ __( "Shadow Blur" ) }
                                reset={ true }
                                value={ data['width']["bottom"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'bottom' ) }
                                min={ 0 }
                                max={ 100 }
                            />
                            <Range
                                label={ __( "Shadow Spread" ) }
                                reset={ true }
                                value={ data['width']["left"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'left' ) }
                                min={ 0 }
                                max={ 100 }
                            />

                            <div className="dowp-toggle-control-field">
                                <ToggleControl
                                    label="Inset"
                                    checked={ data['inset'] }
                                    onChange={ ( val ) => setSettings( val, 'inset' ) }
                                />
                            </div>

                            { transition && (
                                <Range
                                    label={ __( "Shadow Transition" ) }
                                    reset={ true }
                                    value={ data['transition'] }
                                    onChange={ ( val ) => setSettings( val, 'transition' ) }
                                    min={ 0 }
                                    max={ 5 }
                                    step={ 0.1 }
                                />
                            ) }
                        </div>

                    ) }


                />

            </div>
        </div>
    );
};

export default BoxShadow;
