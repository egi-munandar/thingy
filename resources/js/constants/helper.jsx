import React, { Fragment } from "react";
import PropTypes from "prop-types";
import { CSpinner, CToast, CToastBody, CToastHeader } from "@coreui/react";
import axios from "axios";
import Swal from "sweetalert2";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faCheck,
    faPaperPlane,
    faSync,
} from "@fortawesome/free-solid-svg-icons";
import { CircularProgressbar, buildStyles } from "react-circular-progressbar";
import "react-circular-progressbar/dist/styles.css";

export function SubmitButton({
    loading = false,
    disabled,
    text = "Submit",
    variant = "success",
    onClick = () => {},
    btnType = "button",
    form = "",
    icon = <FontAwesomeIcon icon={faPaperPlane} />,
}) {
    return (
        <button
            form={form}
            type={btnType}
            onClick={onClick}
            className={"btn btn-" + variant}
            disabled={disabled}
        >
            {loading ? (
                <CSpinner size="sm" component="span" aria-hidden="true" />
            ) : (
                icon
            )}
            <span className="ms-1">{text}</span>
        </button>
    );
}
export function ProgressButton({
    progress = 0,
    loading = false,
    disabled,
    text = "Submit",
    variant = "success",
    onClick = () => {},
    btnType = "button",
    form = "",
    icon = <FontAwesomeIcon icon={faPaperPlane} />,
}) {
    return (
        <button
            form={form}
            type={btnType}
            onClick={onClick}
            className={"btn btn-" + variant}
            disabled={disabled}
        >
            {loading ? (
                <div style={{ width: 20 }}>
                    <CircularProgressbar
                        strokeWidth={50}
                        styles={buildStyles({
                            strokeLinecap: "butt",
                        })}
                        value={progress}
                        text={`${progress}%`}
                    />
                </div>
            ) : (
                <Fragment>
                    {icon}
                    <span className="ms-1">{text}</span>
                </Fragment>
            )}
        </button>
    );
}
ProgressButton.propTypes = {
    progress: PropTypes.number,
    loading: PropTypes.bool,
    disabled: PropTypes.bool,
    text: PropTypes.string,
    icon: PropTypes.any,
    variant: PropTypes.string,
    btnType: PropTypes.oneOf(["button", "submit"]),
    form: PropTypes.string,
    onClick: PropTypes.func,
};
SubmitButton.propTypes = {
    loading: PropTypes.bool,
    disabled: PropTypes.bool,
    text: PropTypes.string,
    icon: PropTypes.any,
    variant: PropTypes.string,
    btnType: PropTypes.oneOf(["button", "submit"]),
    form: PropTypes.string,
    onClick: PropTypes.func,
};
export const newToast = (
    title,
    body,
    timestamp = "",
    icon = <FontAwesomeIcon icon={faCheck} />,
    autoHide = true,
    delay = 3000
) => (
    <CToast delay={delay} autohide={autoHide}>
        <CToastHeader closeButton>
            <span className="me-1">{icon}</span>
            <strong className="me-auto">{title}</strong>
            <small>{timestamp}</small>
        </CToastHeader>
        <CToastBody>{body}</CToastBody>
    </CToast>
);
export const getUser = (token) =>
    new Promise((res, rej) => {
        axios
            .post(
                process.env.REACT_APP_API_URL + "/get-user",
                {},
                {
                    headers: {
                        Authorization: "Bearer " + token,
                    },
                }
            )
            .then(({ data }) => res(data))
            .catch((e) => rej(e));
    });
export const logOut = (token) =>
    new Promise((res, rej) => {
        axios
            .post(process.env.REACT_APP_API_URL + "/logout")
            .then(({ data }) => {
                res(data);
            })
            .catch((e) => rej(e));
    });
export const errCatch = (e) => {
    if (e.response) {
        if (e.response.status === 422) {
            const ed = e.response.data;
            let htm = "";
            Object.keys(ed.errors).map((key, index) => {
                let val = ed.errors[key];
                htm += '<div class="border-bottom-dashed border-gray-300">';
                htm +=
                    "<b>" +
                    key +
                    "</b> <ul><li>" +
                    val.join("</li><li>") +
                    "</li></ul>";
                htm += "</div>";
                return 1;
            });
            htm += "</tbody></table>";
            Swal.fire({
                title: ed.message,
                icon: "error",
                html: htm,
            });
        } else {
            Swal.fire("Error!", e.response.status.toString(), "error");
        }
    } else {
        Swal.fire("Error!", "check logs for detail", "error");
        console.error(e);
    }
};
export function printDiv(divName) {
    var declaration = "<!DOCTYPE html>";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.documentElement.innerHTML;

    var wd = window.open();
    wd.document.write(declaration + "<html>" + originalContents + "</html>");
    wd.document.body.innerHTML = printContents;
    wd.print();
    wd.close();
}
export const LoadingComponent = () => (
    <div
        style={{ height: "100vh" }}
        className="w-100 d-flex justify-content-center align-items-center"
    >
        <FontAwesomeIcon icon={faSync} className="fs-2" spin />
    </div>
);
export const can = (permission, user) =>
    (user.perms || []).filter((el) => [...permission, "SU"].includes(el)).length
        ? true
        : false;
