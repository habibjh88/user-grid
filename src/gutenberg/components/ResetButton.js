import {Button} from "@wordpress/components";
function ResetButton(props) {

    const {defaultData, onChange} = props

    return (
        <Button
            isSmall
            className="dowp-undo-btn"
            onClick={() => onChange()}
        >
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.80449 1.24854C7.83583 1.24854 8.8688 1.54128 9.79175 2.0952C10.3772 2.44741 10.9032 2.89016 11.3501 3.407L9.80815 3.35612C9.62708 3.35009 9.47543 3.4921 9.46948 3.67328C9.46354 3.85437 9.60545 4.00613 9.78663 4.01195L11.92 4.08241C11.9799 4.10708 12.0458 4.11346 12.1094 4.10072C12.1729 4.08799 12.2313 4.05672 12.2771 4.01085C12.3229 3.96497 12.3541 3.90655 12.3667 3.84297C12.3793 3.77939 12.3728 3.71349 12.3481 3.65359L12.2778 1.52077C12.2737 1.3396 12.1235 1.19604 11.9423 1.20003C11.7612 1.20415 11.6175 1.35438 11.6216 1.53545C11.6216 1.53789 11.6216 1.54017 11.6218 1.54254L11.6624 2.77298C11.2111 2.29066 10.6952 1.87313 10.1294 1.53227C9.10452 0.917339 7.95477 0.592285 6.80449 0.592285C4.96699 0.592285 3.27282 1.34994 2.03479 2.72562C0.93801 3.94428 0.283203 5.58462 0.283203 7.11358C0.283203 7.29475 0.430046 7.4417 0.611328 7.4417C0.792611 7.4417 0.939454 7.29475 0.939454 7.11358C0.939454 5.7423 1.53121 4.26605 2.52257 3.16468C3.6347 1.9292 5.15528 1.24854 6.80449 1.24854ZM13.0801 6.78545C12.8988 6.78545 12.752 6.93227 12.752 7.11358C12.752 8.48472 12.1602 9.96107 11.1688 11.0626C10.0567 12.2981 8.53616 12.9785 6.88695 12.9785C5.85558 12.9785 4.82262 12.686 3.89967 12.132C3.31425 11.7798 2.7883 11.337 2.34136 10.8203L3.88326 10.8711C4.06433 10.877 4.21598 10.735 4.22194 10.5539C4.22787 10.3728 4.08596 10.2211 3.90479 10.2151L1.77145 10.1447C1.71152 10.12 1.64561 10.1136 1.58205 10.1263C1.51848 10.1391 1.46011 10.1703 1.41431 10.2162C1.3685 10.2621 1.33731 10.3205 1.32468 10.3841C1.31205 10.4476 1.31854 10.5135 1.34334 10.5734L1.41361 12.7062C1.4177 12.8876 1.56791 13.0312 1.74908 13.0271C1.93021 13.0231 2.07395 12.8729 2.06986 12.6917C2.06986 12.6893 2.06986 12.6871 2.06965 12.6846L2.02904 11.4541C2.48035 11.9365 2.99622 12.3541 3.56199 12.695C4.58687 13.31 5.73664 13.6349 6.88692 13.6349C8.72442 13.6349 10.4186 12.8774 11.6566 11.5017C12.7534 10.283 13.4082 8.64264 13.4082 7.11358C13.4082 6.93227 13.2614 6.78545 13.0801 6.78545Z" fill="black"/>
            </svg>

        </Button>
    )

}

export default ResetButton