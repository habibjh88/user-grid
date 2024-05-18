const {__} = wp.i18n;
import './scss/styles.scss'

function Styles(props) {

    const {label, value, options, columns = 3, onChange} = props

    return (
        <div className="dowp-control-field components-base-control dowp-cf-styles-wrap">

            {label && (
                <div className="dowp-cf-head">
                    <span className="dowp-label">{label}</span>
                </div>
            )}
            <div className={`dowp-style-list dowp-style-columns-${columns}`}>
                {options.map((data, index) => (
                    <div
                        role="button"
                        tabindex={index} aria-label={data.label ? data.label : ''}
                        onClick={() => onChange(data.value)}
                        className={`${value == data.value ? 'dowp-active' : ''}`}
                    >
                        {data.icon && <span className="dowp-layout dowp-style-icon">{data.icon}</span>}
                        {data.label && <span className="dowp-label">{data.label}</span>}
                    </div>
                ))}

            </div>
        </div>
    )

}




export default Styles