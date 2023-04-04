import PropTypes from 'prop-types';
import classnames from 'classnames';

const {Component} = wp.element;
const {__} = wp.i18n;

class Page extends Component {
    render() {
        const {
            className,
            isCurrent,
            isDots,
            children,
            pageKey,
            onClick
        } = this.props;

        const classes = classnames(
            className,
            {'active': isCurrent},
            {'dots': isDots}
        );
        return (
            <li className={classes}>
                <a onClick={() => onClick()} href='#'>
                    {
                        pageKey === 'prev' &&
                        <span className="fa fa-angle-double-left"/>
                    }
                    {__(children)}
                    {
                        pageKey === 'next' &&
                        <span className="fa fa-angle-double-right"/>
                    }
                </a>
            </li>
        );
    }
}

Page.defaultProps = {
    isCurrent: false,
    isDots: false,
    className: ''
}
Page.propTypes = {
    isCurrent: PropTypes.bool,
    className: PropTypes.string,
    key: PropTypes.string,
    isDots: PropTypes.bool,
    onClick: PropTypes.func
};
export default Page;