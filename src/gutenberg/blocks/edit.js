const {useEffect, useState} = wp.element;
import apiFetch from "@wordpress/api-fetch";
import Inspector from "./inspector";
import CustomUsersBlock from "./layouts/CustomUsersBlock";
import {CssGenerator} from "../utils/css/CssGenerator";
import {CATEGORY_PREVIEW} from "../components/Constants";
const Edit = (props) => {
    const {isSelected, attributes, setAttributes} = props;

    //all attribute
    const {
        layout,
        name_tag,
        preview,
        uniqueId,
        users_lists,
        grid_column,
        content_order,
        users_role,
        image_size,
        avatar_dimension,
        user_limit,
        user_filter_by_domain,
        orderby,
        order,
        avatar_visibility,
        name_visibility,
        email_visibility,
        designation_visibility,
        short_desc_visibility,
        bio_visibility,
        social_visibility,
        button_style,
        button_visibility,
    } = attributes;

    //set block preview
    if (preview) {
        return CATEGORY_PREVIEW;
    }

    const [users, setUsers] = useState([]);
    const [userData, setUserData] = useState([]);
    const [signalController, setSignalController] = useState();
    const [queryEffect, setQueryEffect] = useState(false);
    const controller = typeof AbortController === 'undefined' ? undefined : new AbortController();

    const handleQueryChange = () => {
        setQueryEffect(!queryEffect);
    }

    const fetch_all_users_frontend = () => {
        signalController?.abort();
        setSignalController(controller);
        setUsers({})
        apiFetch({
            path: '/dowp/v1/users',
            signal: controller?.signal,
            method: 'POST',
            data: {
                layout,
                name_tag,
                users_lists,
                grid_column,
                content_order,
                user_limit,
                users_role,
                image_size,
                avatar_dimension,
                user_filter_by_domain,
                orderby,
                order,
                avatar_visibility,
                name_visibility,
                email_visibility,
                designation_visibility,
                short_desc_visibility,
                bio_visibility,
                social_visibility,
                button_style,
                button_visibility,
            }
        }).then((data) => {
            setAttributes({query_change: false})
            setUsers(data)
        });
    }
    const fetch_users_data_inspector = () => {
        signalController?.abort();
        setSignalController(controller);
        setUsers({})
        apiFetch({
            path: '/dowp/v1/users-select',
            signal: controller?.signal,
            method: 'POST',
        }).then((data) => {
            setAttributes({query_change: false})
            setUserData(data)
        });
    }

    // Fetch All Posts
    //== == == == == == == ==
    useEffect(() => {
        fetch_all_users_frontend();
    }, [queryEffect]);

    useEffect(() => {
        fetch_users_data_inspector();
    }, []);

    if (uniqueId) {
        CssGenerator(attributes, 'user-grid', uniqueId);
    }

    //render
    return [
        isSelected && (
            <Inspector
                attributes={attributes}
                setAttributes={setAttributes}
                changeQuery={handleQueryChange}
                userData={userData}
            />
        ),
        
        <CustomUsersBlock props={props} userData={users}/>
    
    ]
}
export default Edit;
