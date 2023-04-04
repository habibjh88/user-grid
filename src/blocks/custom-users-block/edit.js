const {useEffect, useState} = wp.element;
import apiFetch from "@wordpress/api-fetch";
import Inspector from "./inspector";
import CustomUsersBlock from "./layouts/CustomUsersBlock";
import {CssGenerator} from "../../utils/css/CssGenerator";
import icons from "../../components/icon/icons";


const Edit = (props) => {
    const {isSelected, attributes, setAttributes} = props;

    //all attribute
    const {
        preview,
        uniqueId,
        users_lists,
        image_size,
        avatar_dimension,
    } = attributes;

    //set block preview
    if (preview) {
        return icons.slider_preview;
    }

    const [userData, setUserData] = useState([]);
    const [users, setUsers] = useState([]);
    const [signalController, setSignalController] = useState();
    const [queryEffect, setQueryEffect] = useState(false);
    const [imageSizes, setImageSizes] = useState([]);
    const controller = typeof AbortController === 'undefined' ? undefined : new AbortController();

    console.log(imageSizes)
    const handleQueryChange = () => {
        setQueryEffect(!queryEffect);
    }

    const fetch_all_image_size = () => {
        signalController?.abort();
        setSignalController(controller);
        apiFetch({path: "/rttpg/v1/image-size", signal: controller?.signal})
            .then((imageSizes) => {
                let newImageSize = imageSizes.filter(item => {
                    return item.value !== 'custom';
                })
                setImageSizes(newImageSize)
            })
    }

    const fetch_all_users = () => {
        signalController?.abort();
        setSignalController(controller);
        setUsers({})
        apiFetch({
            path: '/rgbcode/v1/users',
            signal: controller?.signal,
            method: 'POST',
            data: {
                users: 'all',
                users_lists,
                image_size,
                avatar_dimension,
            }
        }).then((data) => {
            setAttributes({query_change: false})
            setUsers(data)
        });
    }

    const fetch_users_data = () => {
        signalController?.abort();
        setSignalController(controller);
        setUsers({})
        apiFetch({
            path: '/rgbcode/v1/users',
            signal: controller?.signal,
            method: 'POST',
            data: {
                users: 'ids',
            }
        }).then((data) => {
            setAttributes({query_change: false})
            setUserData(data)
        });
    }

    // Fetch All Posts
    //== == == == == == == ==
    useEffect(() => {
        fetch_all_users();
    }, [queryEffect]);

    useEffect(() => {
        fetch_users_data();
    }, []);


    useEffect(() => {
        fetch_all_image_size();
    }, []);

    useEffect(() => {
        const sidebarEl = document.querySelector('.interface-interface-skeleton__sidebar');
        sidebarEl.classList.add('tpg-sidebar')
        sidebarEl.classList.remove('tpg-settings-enable')
        sidebarEl.addEventListener('click', function (event) {
            const hasClass = event.target.classList.contains('rttpg-tab-btn');
            if (hasClass) {
                const selectText = event.target.textContent;
                if (selectText !== 'Content') {
                    this.classList.add('tpg-settings-enable')
                } else {
                    this.classList.remove('tpg-settings-enable')
                }
            }
        })
        sidebarEl.addEventListener('scroll', function (e) {
            if (e.target.scrollTop > 86) {
                this.classList.add('tpg-should-collapse');
            } else {
                this.classList.remove('tpg-should-collapse');
            }
        })

    }, [isSelected]);

    if (uniqueId) {
        CssGenerator(attributes, 'custom-users-block', uniqueId);
    }

    //render
    return [
        isSelected && (
            <Inspector
                attributes={attributes}
                setAttributes={setAttributes}
                changeQuery={handleQueryChange}
                imageSizes={imageSizes}
                userData={userData}
            />
        ),

        <CustomUsersBlock props={props} userData={users} changeQuery={handleQueryChange}/>

    ]
}
export default Edit;
