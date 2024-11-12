const {__} = wp.i18n;
import './scss/styles.scss'
function Styles(props) {

    const {label, value, options, columns = 3, onChange} = props

    return (
        <div className="usgr-control-field components-base-control usgr-cf-styles-wrap">

            {label && (
                <div className="usgr-cf-head">
                    <span className="usgr-label">{label}</span>
                </div>
            )}
            <div className={`usgr-style-list usgr-style-columns-${columns}`}>
                {options.map((data, index) => (
                    <div
                        role="button"
                        tabindex={index} aria-label={data.label ? data.label : ''}
                        onClick={() => onChange(data.value)}
                        className={`${value == data.value ? 'usgr-active' : ''}`}
                    >
                        {data.icon && <span className="usgr-layout usgr-style-icon">{data.icon}</span>}
                        {data.label && <span className="usgr-label">{data.label}</span>}
                    </div>
                ))}

            </div>
        </div>
    )

}




export default Styles