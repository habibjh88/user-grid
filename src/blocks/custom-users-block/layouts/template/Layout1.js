const {__} = wp.i18n;
import {Button, Modal} from '@wordpress/components';
import {useState} from '@wordpress/element';

function Layout1({attributes, user}) {

    const {
        grid_column,
        name_tag,
        avatar_visibility,
        name_visibility,
        email_visibility,
        bio_visibility,
        social_visibility,
    } = attributes;

    const [isOpen, setOpen] = useState(false);
    const openModal = () => setOpen(true);
    const closeModal = () => setOpen(false);

    //Grid Column settings
    let default_grid_column_desktop = '4';
    let default_grid_column_tab = '6';
    let default_grid_column_mobile = '12';

    let grid_column_desktop = grid_column?.lg ? grid_column.lg : default_grid_column_desktop;
    let grid_column_tab = grid_column?.md ? grid_column.md : default_grid_column_tab;
    let grid_column_mobile = grid_column?.sm ? grid_column.sm : default_grid_column_mobile;

    const user_column = `cub-col-md-${grid_column_desktop} cub-col-sm-${grid_column_tab} cub-col-xs-${grid_column_mobile}`;
    const HeadingTag = `${name_tag}`;

    return (
        <div key={user.id} className={`user-item-col ${user_column}`}>
            <div className="user-inner-wrapper">
                {user.avatar && avatar_visibility &&
                    <div className="user-avatar">
                        <a className="user-link">
                            <img src={user.avatar}
                                 className="user-image"
                                 alt={user.name}
                                 decoding="async"
                                 loading="lazy"/>
                        </a>
                    </div>
                }

                <div className="user-content-wrap clearfix">
                    {name_visibility &&
                        <HeadingTag className="user-name">
                            <a>{user.name}</a>
                        </HeadingTag>
                    }
                    {email_visibility &&
                        <div className="user-email">
                            <a href={`mainto:${user.email}`}>{user.email}</a>
                        </div>
                    }

                    {social_visibility === 'show' &&
                        <div className="cub-user-social-icons">
                            {user.social.facebook &&
                                <a className="facebook" href={user.social.facebook}><i
                                    className="dashicons dashicons-facebook-alt"></i></a>
                            }
                            {user.social.twitter &&
                                <a className="twitter" href={user.social.twitter}><i
                                    className="dashicons dashicons-twitter"></i></a>
                            }

                            {user.social.linkedin &&
                                <a className="linkedin" href={user.social.linkedin}><i
                                    className="dashicons dashicons-linkedin"></i></a>
                            }
                            {user.social.gplus &&
                                <a className="google" href={user.social.gplus}><i
                                    className="dashicons dashicons-google"></i></a>
                            }
                            {user.social.pinterest &&
                                <a className="pinterest" href={user.social.pinterest}><i
                                    className="dashicons dashicons-pinterest"></i></a>
                            }

                        </div>
                    }

                    {bio_visibility && <>
                        <Button className="load-user-button" variant="secondary" onClick={openModal}>
                            {__("Load users's biography")}
                        </Button>

                        {isOpen && (
                            <Modal className={`cub-users-block-modal`} title={__("Users Biography")}
                                   onRequestClose={closeModal}>
                                <p className="user-biography">{user.biography}</p>
                            </Modal>
                        )}

                    </>}
                </div>
            </div>

        </div>
    );
}

export default Layout1;
