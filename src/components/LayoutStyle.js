const {__} = wp.i18n
const {useState} = wp.element;
const {Tooltip} = wp.components;
import "./scss/LayoutStyle.scss";

const LayoutStyle = (props) => {

    const {value, responsive, onChange, label, options} = props;
    const _filterValue = () => {
        return value ?? '';
    }
    const setSettings = (val) => {
        console.log(val)
        if (val == '') {
            return;
        }

        onChange(val);
    }

    const defaultData = options && Array.isArray(options) ? options : ['left', 'center', 'right', 'justify'];

    return (
        <div className="dowp-control-field components-base-control dowp-cf-layout-style">

            {(label || responsive) && (
                <div className="dowp-cf-head">
                    {label && (
                        <span className="dowp-label">{label}</span>
                    )}
                </div>
            )}

            <div className="dowp-cf-body dowp-btn-group">

                {defaultData.map((data, index) => {
                    return (
                        <button className={(_filterValue() == data ? 'active' : '') + ' dowp-button'}
                                key={index}
                                onClick={() => setSettings(_filterValue() == data ? '' : data)}>
                            {(data == 'left' || data === 'flex-start') &&
                                <Tooltip text={__('Left')}>
                                    <svg width="49" height="16" viewBox="0 0 49 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M0 10.2857V0H22.6154V10.2857H0ZM1.25641 1.14286H21.359V9.14286H1.25641V1.14286Z"
                                              fill="#62B3EB"/>
                                        <path d="M0 13.7143H20.1026V12.5714H0V13.7143Z" fill="#62B3EB"/>
                                        <path d="M17.5897 16H0V14.8571H17.5897V16Z" fill="#62B3EB"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M26.3846 10.2857V0H49V10.2857H26.3846ZM27.641 1.14286H47.7436V9.14286H27.641V1.14286Z"
                                              fill="#62B3EB"/>
                                        <path d="M46.4872 13.7143H26.3846V12.5714H46.4872V13.7143Z" fill="#62B3EB"/>
                                        <path d="M26.3846 16H43.9744V14.8571H26.3846V16Z" fill="#62B3EB"/>
                                    </svg>
                                </Tooltip>
                            }
                            {data == 'center' &&
                                <Tooltip text={__('Middle')}>
                                    <i className="dashicons dashicons-editor-aligncenter"></i>
                                </Tooltip>
                            }
                            {(data == 'right' || data === 'flex-end') &&
                                <Tooltip text={__('Right')}>
                                    <i class="dashicons dashicons-editor-alignright"></i>
                                </Tooltip>
                            }
                            {(data == 'justify') &&
                                <Tooltip text={__('Right')}>
                                    <i class="dashicons dashicons-editor-justify"></i>
                                </Tooltip>
                            }
                        </button>
                    )
                })}

            </div>
        </div>
    )
}

export default LayoutStyle;