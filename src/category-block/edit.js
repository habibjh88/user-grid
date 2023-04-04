const {useEffect, useState} = wp.element;
import apiFetch from "@wordpress/api-fetch";
import Inspector from "./inspector";
import {CssGenerator} from "../../../../the-post-grid/src/utils/css/CssGenerator";
import CategoryLayout from "./layouts/CategoryLayout";
import icons from "../../../../the-post-grid/src/components/icon/icons";

const Edit = (props) => {
    const {isSelected, attributes, setAttributes} = props;

    //all attribute
    const {
        preview,
        uniqueId,
        category_lists,
        image_size,
    } = attributes;

    //set block preview
    if (preview) {
        return icons.slider_preview;
    }

    const [category, setCategory] = useState([]);
    const [signalController, setSignalController] = useState();
    const [queryEffect, setQueryEffect] = useState(false);
    const [imageSizes, setImageSizes] = useState([]);
    const controller = typeof AbortController === 'undefined' ? undefined : new AbortController();

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

    const fetch_all_posts = () => {
        signalController?.abort();
        setSignalController(controller);
        setCategory({})
        apiFetch({
            path: '/rttpg/v1/categories',
            signal: controller?.signal,
            method: 'POST',
            data: {
                category_lists,
                image_size,
            }
        }).then((data) => {
            setAttributes({query_change: false})
            setCategory(data)
        });
    }

    // Fetch All Posts
    //== == == == == == == ==
    useEffect(() => {
        fetch_all_posts();
    }, [queryEffect]);


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
        CssGenerator(attributes, 'tpg-category-block', uniqueId);
    }

    //render
    return [
        isSelected && (
            <Inspector
                attributes={attributes}
                setAttributes={setAttributes}
                changeQuery={handleQueryChange}
                imageSizes={imageSizes}
            />
        ),

        <CategoryLayout props={props} catData={category} changeQuery={handleQueryChange}/>

    ]
}
export default Edit;
